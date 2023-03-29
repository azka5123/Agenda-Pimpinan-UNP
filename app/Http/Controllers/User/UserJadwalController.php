<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserJadwalController extends Controller
{
   
    public function index()
    {
        $events = Jadwal::all();
        return view('user.jadwal.show_jadwal', compact('events'));
    }

    public function create()
    {        
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        $user = User::where('id','1')->first();
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator'=> '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }
        return view('user.jadwal.create_jadwal',compact('events','jadwal','user'));
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
        $store->keterangan = $request->keterangan;
        $store->save();

        return redirect()->route('show_jadwal')->with('success', 'Data berhasil ditambahkan');

       
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        $user = User::where('id',Auth::user()->id)->first();
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

   
    public function show()
    {
        $events = Jadwal::all();
 
        $jadwal = Jadwal::with(['rUser'])->where('user_id', Auth::user()->id)->get();
        foreach ($jadwal as $time) {
            $events[] = [
                'title' => $time->keterangan,
                'defaultRangeSeparator'=> '-',
                'start' => $time->start_time,
                'end' => $time->finish_time,
            ];
        }

        $user = Jadwal::orderBy('id', 'asc')->get();
        return view('user.jadwal.show_jadwal', compact('user','events'));        
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
        
        return view('user.jadwal.edit_jadwal', compact('edit','dosen'));
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
