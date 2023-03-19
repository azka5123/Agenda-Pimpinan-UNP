<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiUserController extends Controller
{
    public function index()
    {
        return Jadwal::all();
    }

    public function show($id)
    {
        return Jadwal::find($id);
    }

    public function store(Request $request)
    {
        // DB::table('jadwals')->insert([
        //     'user_id'=>$request->user_id,
        //     'keterangan'=>$request->keterangan,
        //     'start_time'=>$request->start_time,
        //     'finish_time'=>$request->finish_time,
        //     
        // ]);

        $store = new Jadwal();
        $store->user_id = $request->user_id;
        $store->keterangan = $request->keterangan;
        $store->start_time = $request->start_time;
        $store->finish_time = $request->finish_time;
        $store->save();

        // $store =  Jadwal::create($request->all());
        return response()->json($store);
    }

    public function update(Request $request, $id)
    {
        $update = Jadwal::findOrFail($id);
        $update->user_id = $request->user_id;
        $update->keterangan = $request->keterangan;
        $update->start_time = $request->start_time;
        $update->finish_time = $request->finish_time;  
        $update->update();
        return response()->json($update);
    }

    public function delete($id)
    {
        $delete = Jadwal::findOrFail($id);
        $delete->delete();

        return 204;
    }
}
