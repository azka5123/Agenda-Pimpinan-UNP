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
    public function render(Request $request)
    {
        $users = User::orderBy('id', 'asc')->get();
        if ($this->search !== null) {
            $users = User::where('nama', 'like', '%' . $this->search . '%')->orWhere('jabatan', 'like', '%' . $this->search . '%')->paginate(5);
        }
        return view('livewire.user-data', compact('users'));
    }
}
