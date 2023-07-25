<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = [
        'created_at','updated_at'
    ];

}
