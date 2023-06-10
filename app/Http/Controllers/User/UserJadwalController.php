<?php

namespace App\Http\Controllers\User;

use App\Events\EventJadwal;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notifications;
use App\Notifications\JadwalNotif;
use App\Notifications\JadwalNotif2;
use Berkayk\OneSignal\OneSignalFacade;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class UserJadwalController extends Controller
{

    public function index()
    {
        $events = Jadwal::all();

        // $notificationCount = auth()->user()->unreadNotifications->count();
        return view('user.jadwal.show_jadwal', compact('events', 'jumlah_notif'));
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function create()
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = Carbon::now();
        $tgl = $now->format('Y-m-d H:i');
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        $user = User::where('id', '1')->first();
        $events[] = [];
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator' => '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }
        return view('user.jadwal.create_jadwal', compact('events', 'jadwal', 'user', 'tgl'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required',
            'title' => 'required',
        ]);
        $user = User::where('id', Auth::user()->id)->first();
        $store = new Jadwal();
        $store->user_id = Auth::user()->id;
        $store->title = $request->title;
        $start = $store->start_time = $request->start_time;
        $end = $store->finish_time = $request->finish_time;
        if ($start == $end) {
            return redirect()->back()->with('error', 'Waktu tidak boleh sama');
        }
        $ket = $store->keterangan = $request->keterangan;
        // $test = User::find(Auth::user()->id);
        // $when = now()->addMinutes(2);
        $store->save();

        $pengingat = Carbon::parse($request->start_time);
        $now = Carbon::now();
        if ($now->diffInHours($pengingat) < 1) {
            $task = User::findOrFail(Auth::user()->id);
            $task->notify(new JadwalNotif2($ket));
            if ($user->onesignal_id_flutter) {
                $message = "Acara " . $ket . " akan segera dimulai kurang dari 1 jam lagi.";
                $userId = [$user->onesignal_id_flutter];
                $title = 'Pengingat';
                $params = [
                    'headings' => ['en' => $title],
                    'contents' => ['en' => $message],
                    'include_player_ids' => [$userId],
                ];
                OneSignalFacade::sendNotificationCustom($params);
            }
        } else {
            $task = User::findOrFail(Auth::user()->id);
            $tgl = $pengingat->subHours(1);
            $task->notifyAt(new JadwalNotif($ket), $tgl);
            if ($user->onesignal_id_flutter) {
                $message = "Acara " . $ket . " akan segera dimulai dalam 1 jam lagi.";
                $userId = [$user->onesignal_id_flutter];
                $title = 'Pengingat';
                $params = [
                    'headings' => ['id' => $title],
                    'contents' => ['id' => $message],
                    'include_player_ids' => $userId,
                    'send_after' => $tgl,
                ];
                OneSignalFacade::sendNotificationCustom($params);
            }
        }
        return redirect()->route('show_jadwal')->with('success', 'Data berhasil ditambahkan');
    }

    public function popover($id)
    {
        $edit = Jadwal::where('id', $id)->first();
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        foreach ($jadwal as $time) {
            $events[] = [
                'id' => $time->id,
                'title' => $time->title,
                'defaultRangeSeparator' => '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }


        return view('user.jadwal.popover', compact('edit', 'events'));
    }

    public function update_popover(Request $request, $id)
    {
        $request->validate([

            'keterangan' => 'nullable',
        ]);

        $update = Jadwal::where('id', $id)->first();

        $update->keterangan = $request->keterangan;

        $update->update();

        return redirect()->route('show_jadwal')->with('success', 'Data berhasil diedit');
    }

    public function show()
    {
        // $events = Jadwal::all();
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        foreach ($jadwal as $time) {
            $events[] = [
                'id' => $time->id,
                'title' => $time->title,
                'defaultRangeSeparator' => '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
                'keterangan' => $time->keterangan,
            ];
        }

        $user = Jadwal::orderBy('id', 'asc')->get();
        // return response()->json(view('user.jadwal.show_jadwal', compact('user', 'events')));
        return view('user.jadwal.show_jadwal', compact('user', 'events'));
    }

    public function unread()
    {
        $jumlah_notif = Notifications::where('notifiable_id', Auth::user()->id)->where('read_at', null)->get();
        return response()->json([
            'notifications' => $jumlah_notif,
        ]);
    }

    public function show2()
    {
        $user = Jadwal::where('user_id', Auth::user()->id)->orderBy('start_time', 'asc')->get();
        return view('user.jadwal.all', compact('user'));
    }


    public function edit($id)
    {
        $edit = Jadwal::where('id', $id)->first();
        $dosen = User::all();

        return view('user.jadwal.edit_jadwal', compact('edit', 'dosen'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([

            'title' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
            'keterangan' => 'nullable',
        ]);

        $update = Jadwal::where('id', $id)->first();
        $update->title = $request->title;
        $update->start_time = $request->start_time;
        $update->finish_time = $request->finish_time;
        $update->keterangan = $request->keterangan;

        $update->update();

        return redirect()->route('show_jadwal')->with('success', 'Data berhasil diedit');
    }


    public function delete($id)
    {
        Jadwal::where('id', $id)->delete();
        return redirect()->route('show_jadwal')->with('success', 'Data berhasil dihapus');
    }
}
