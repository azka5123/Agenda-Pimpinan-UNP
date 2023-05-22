<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;



class FrontHomeController extends Controller
{
    public function show()
    {
        $events = [];
        $nama = 'nama';
        $jabatan = 'jabatan';
        return view('front.home', compact('events', 'nama', 'jabatan'));


        return view('front.home', compact('events'));
    }

    public function show2(Request $request, $nama)
    {
        $events = [];
        // $decoded_id = Hashids::decode($id);
        $jadwal = user::with('rJadwal')->where('nama', $nama)->get();
        // dd($jadwal);
        // die;
        // $user = User::where('nama', $nama)->first();
        foreach ($jadwal as $user) {
            foreach ($user->rJadwal as $time) {
                $events[] = [
                    'title' => $time->keterangan,
                    'defaultRangeSeparator' => '-',
                    'start' => $time->start_time,
                    'end' => $time->finish_time,
                ];
            }
        }
        return view('front.home', compact('events', 'jadwal', 'user'));
    }

    public function reload($nama)
    {
        $events = [];
        // $decoded_id = Hashids::decode($id);
        $jadwal = user::with('rJadwal')->where('nama', $nama)->get();
        // dd($jadwal);
        // die;
        // $user = User::where('nama', $nama)->first();
        foreach ($jadwal as $user) {
            foreach ($user->rJadwal as $time) {
                $events[] = [
                    'title' => $time->keterangan,
                    'defaultRangeSeparator' => '-',
                    'start' => $time->start_time,
                    'end' => $time->finish_time,
                ];
            }
        }
        return response()->json($events);
    }
}
