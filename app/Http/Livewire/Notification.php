<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Notification extends Component
{
    public function render()
    {
        $resets = DB::table('reset_password_permissions')->join('users','reset_password_permissions.reset_user_id','users.id')->where('reset_status','No')->select('reset_password_permissions.*','users.name')->get();
        return view('livewire.notification',compact('resets'));
    }
}
