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
        $nama = '';
        $jabatan= '';
        return view('front.home',compact('events','nama','jabatan'));
        
    }

    public function show2(Request $request, $id,$nama)
    {
        $events = [];
        $decoded_id = Hashids::decode($id);
        $jadwal = Jadwal::with(['rUser'])->where('user_id',$decoded_id)->get();
        // dd($jadwal);die;
        $user = User::where('id',$decoded_id)->first();
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator'=> '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }
        return view('front.home',compact('events','jadwal','user'));
    }

    

}
