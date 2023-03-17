<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dosen = User::all();
        return view('user.jadwal.create_jadwal',compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'user_id' => 'required',
            'start_time' => 'required',
            'keterangan' => 'required',
        ]);

        $store = new Jadwal();
        $store->user_id = $request->user_id;
        $store->start_time = $request->start_time;
        $store->finish_time = $request->finish_time;
        $store->keterangan = $request->keterangan;
        $store->save();

        return redirect()->route('show_jadwal')->with('success', 'data berhasil ditambahkan');
    }

   
    public function show()
    {
        $user = Jadwal::orderBy('id', 'asc')->get();
        return view('user.jadwal.show_jadwal', compact('user'));

        
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

        return redirect()->route('show_jadwal')->with('success', 'data berhasil diedit');
    }

   
    public function delete($id)
    {
        Jadwal::where('id', $id)->delete();
        return redirect()->route('show_jadwal')->with('success', 'data berhasil dihapus');
    }
}
