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
<<<<<<< HEAD
        $nama = 'nama';
        $jabatan= 'jabatan';
        return view('front.home',compact('events','nama','jabatan'));
        
=======
        return view('front.home', compact('events'));
>>>>>>> 064776835ff978095c690bec468f8eb4951219a4
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
}
