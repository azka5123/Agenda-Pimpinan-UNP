<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    public function show()
    {
        $events = [];
        $data_nama = '';
        return view('front.home',compact('events','data_nama'));
    }

    public function show2($id,$nama)
    {
        $events = [];
 
        $jadwal = Jadwal::with(['rUser'])->where('user_id',$id)->get();
        $data_nama = $nama;
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator'=> '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }
        
        return view('front.home',compact('events','jadwal','data_nama'));
    }

}
