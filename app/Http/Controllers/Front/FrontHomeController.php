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
        $jadwal = Jadwal::with(['rUser'])->get();
        $search = User::orderBy('id','asc')->paginate(2);
        return view('front.home',compact('events','search'));
    }

    // public function search(Request $request)
    // {
    //     $search = User::orderBy('id','asc');
    //     if($request->text != ''){
    //         $test = $search->where('nama','like','%'.$request->text.'%');
    //     }
    //     $search = $test->first();
    //     return view('front.home',compact('search'));
    //     // dd($search);
    // }

    public function show2($id)
    {
        $events = [];
 
        $jadwal = Jadwal::with(['rUser'])->where('user_id',$id)->get();
        $search = User::orderBy('id','asc')->paginate(2);
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator'=> '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }
        
        return view('front.home',compact('events','jadwal','search'));
    }

}
