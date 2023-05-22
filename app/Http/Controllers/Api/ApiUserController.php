<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JadwalResource;
use App\Models\Jadwal;
use App\Models\Notifications;
use App\Models\User;
use App\Notifications\JadwalNotif;
use App\Notifications\JadwalNotif2;
use Berkayk\OneSignal\OneSignalFacade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiUserController extends Controller
{
    public function user()
    {
        return response()->json(Auth::user());
    }

    public function index()
    {
        $jadwal = Jadwal::with('rUser:id,nama,jabatan,email')->get();
        return JadwalResource::collection($jadwal);
    }

    public function show($id)
    {
        $show =  Jadwal::with('rUser:id,nama,jabatan,email')->findOrFail($id);
        return new JadwalResource($show);
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
            // 'onesignal_id_flutter' => 'required'
        ]);
        $task = User::find(Auth::user()->id);
        if ($task->onesignal_id_flutter == '' || $task->onesignal_id_flutter != Auth::user()->onesignal_id_flutter) {
            $task->onesignal_id_flutter = $request['onesignal_id_flutter'];
            $task->update();
        }
        $request['user_id'] = Auth::user()->id;
        $ket = $request['keterangan'];
        $userId = $request['onesignal_id_flutter'];
        // $userId = ['0e63110e-b5a6-4680-8c66-a7fd9c592b35'];
        $store =  Jadwal::create($request->all());
        $pengingat = Carbon::parse($request->start_time);
        $now = Carbon::now();
        if ($now->diffInHours($pengingat) < 1) {
            $task->notify(new JadwalNotif2($ket));

            $message = "Acara " . $ket . " akan segera dimulai kurang dari 1 jam lagi.";
            $title = 'test';
            $params = [
                'headings' => ['en' => $title],
                'contents' => ['en' => $message],
                'include_player_ids' => $userId,
            ];
            OneSignalFacade::sendNotificationCustom($params);
        } else {
            $tgl = $pengingat->subHours(1);
            $task->notifyAt(new JadwalNotif($ket), $tgl);

            $message = "Acara " . $ket . " akan segera dimulai dalam 1 jam lagi.";
            $title = 'test';
            $params = [
                'headings' => ['en' => $title],
                'contents' => ['en' => $message],
                'include_player_ids' => $userId,
                'send_after' => $tgl,
            ];
            OneSignalFacade::sendNotificationCustom($params);
        }

        return new JadwalResource($store->loadMissing('rUser:id,nama,email,jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
        ]);

        $update = Jadwal::findOrFail($id);
        $update->update($request->all());
        return new JadwalResource($update->loadMissing('rUser:id,nama,email,jabatan'));
    }

    public function delete($id)
    {
        $delete = Jadwal::findOrFail($id);
        $delete->delete();

        return 204;
    }

    public function notif()
    {
        $jumlah_notif = Notifications::where('notifiable_id', Auth::user()->id)->where('read_at', null)->get();
        return response()->json([
            'notifications' => $jumlah_notif,
        ]);
    }
}
