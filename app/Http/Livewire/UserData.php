<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserData extends Component
{
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    public function render()
    {
        $users = User::orderBy('id', 'asc')->paginate(1);
        // dd($nama);die;
        if ($this->search !== null) {
            $users = User::where('nama', 'like', '%' . $this->search . '%')->paginate(1);
        }
        return view('livewire.user-data', compact('users'));
    }
}
