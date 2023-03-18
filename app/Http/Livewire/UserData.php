<?php

namespace App\Http\Livewire;

use App\Models\Jadwal;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserData extends Component
{
    public $search;
    public $nama;
    public $jabatan;
    public $uid;
    protected $queryString = ['search' => ['except' => '']];

    // public function submitForm()
    // {
    //     $uid = 1;
    //     $nama = "Azka";
    //     $endpoint = "http://127.0.0.1:8000/"; 
    //     $response = Http::post($endpoint);
    //     // dd($response);die;
    //     if ($response->ok()) {
    //         // Data berhasil dikirim
    //     } else {
    //         // Data gagal dikirim
    //     }
    // }

    public function render(Request $request)
    {
        $users = User::orderBy('id', 'asc')->get();
        if ($this->search !== null) {
            $users = User::where('nama', 'like', '%' . $this->search . '%')->paginate(1);
        }
        return view('livewire.user-data', compact('users'));
    }

    
}
