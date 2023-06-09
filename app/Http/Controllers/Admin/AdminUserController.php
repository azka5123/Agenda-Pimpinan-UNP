<?php

namespace App\Http\Controllers\Admin;

use App\Exports\JadwalExport;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminUserController extends Controller
{
    public function show()
    {
        $user = User::orderBy('id', 'asc')->get();
        return view('admin.user.user_show', compact('user'));
    }

    public function create()
    {
        return view('admin.user.user_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
            'password' => 'required|confirmed',
        ]);

        $store = new User();
        $store->nama = $request->nama;
        $store->email = $request->email;
        $store->jabatan = $request->jabatan;
        $store->password = Hash::make($request->password);
        $store->save();

        return redirect()->route('admin_user_show')->with('success', 'data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $edit = User::where('id', $id)->first();
        return view('admin.user.user_edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'jabatan' => 'required',
        ]);
        $update = User::where('id', $id)->first();
        $update->nama = $request->nama;
        $update->email = $request->email;
        $update->jabatan = $request->jabatan;
        if ($request->password != '') {
            $request->validate([
                'password' => 'required|confirmed',
            ]);
            $update->password = Hash::make($request->new_password);
        }
        $update->update();

        return redirect()->route('admin_user_show')->with('success', 'data berhasil diedit');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('admin_user_show')->with('success', 'data berhasil dihapus');
    }

    public function rekap($id)
    {
        $jadwal = Jadwal::with('rUser')->where('user_id', $id)->get();
        $user = User::find($id);
        // $user = $jadwal->user_id;
        return view('admin.user.user_rekap', compact('user', 'jadwal'));
    }

    public function export($id)
    {
        $nama = User::where('id', $id)->first();
        return Excel::download(new JadwalExport($id), 'rekap kegiatan ' . $nama->nama . '.xlsx');
    }
}
