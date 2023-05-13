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
            'keterangan' => 'required',
        ]);

        $store = new Jadwal();
        $store->user_id = Auth::user()->id;
        $store->start_time = $request->start_time;
        $store->finish_time = $request->finish_time;
        $ket = $store->keterangan = $request->keterangan;
        // $test = User::find(Auth::user()->id);
        // $when = now()->addMinutes(2);
        $store->save();

        $pengingat = Carbon::parse($request->start_time);
        $now = Carbon::now();
        if ($now->diffInHours($pengingat) < 1) {
            $task = User::findOrFail(Auth::user()->id);
            $task->notify(new JadwalNotif2($ket));
        } else {
            $task = User::findOrFail(Auth::user()->id);
            $task->notifyAt(new JadwalNotif($ket), $pengingat->subHours(1));
        }

        // $notif = new EventJadwal('wada');
        // event($notif);


        // $test->notify((new JadwalNotif($store->start_time, $store->keterangan))->delay($when));

        // $task = User::findOrFail(Auth::user()->id);
        // $task->notifyAt(new JadwalNotif('asfd'), Carbon::now()->addMinutes(2));

        // $notif = new JadwalNotif($task);
        // $task->snoozeReminders()->first()->attachNotification($notif);
        // dd($task);
        // die;
        // event(new EventJadwal($task));

        return redirect()->route('show_jadwal')->with('success', 'Data berhasil ditambahkan');
    }


    public function show()
    {
        $events = Jadwal::all();
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator' => '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
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

            'start_time' => 'required',
            'finish_time' => 'required',
            'keterangan' => 'required',
        ]);

        $update = Jadwal::where('id', $id)->first();
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
