<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JadwalResource;
use App\Models\Jadwal;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiUserController extends Controller
{
    public function user()
    {
        return response()->json(Auth::user());
    }

    public function index()
    {
        $jadwal = Jadwal::with('rUser:id,nama,jabatan,email')->get();
        return JadwalResource::collection($jadwal);
    }

    public function show($id)
    {
        $show =  Jadwal::with('rUser:id,nama,jabatan,email')->findOrFail($id);
        return new JadwalResource($show);
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
        ]);
        $request['user_id'] = Auth::user()->id;
        $store =  Jadwal::create($request->all());
        return new JadwalResource($store->loadMissing('rUser:id,nama,email,jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
        ]);

        $update = Jadwal::findOrFail($id);
        $update->update($request->all());
        return new JadwalResource($update->loadMissing('rUser:id,nama,email,jabatan'));
    }

    public function delete($id)
    {
        $delete = Jadwal::findOrFail($id);
        $delete->delete();

        return 204;
    }
}
