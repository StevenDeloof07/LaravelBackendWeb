<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Device extends Model
{
    protected $fillable = [
        "name",
        "release_date",
        "description",
        "picture_link"
    ];

    public function favorite($user_id) {
        if (!empty(DB::table('device_user')
            ->where(['user_id' => $user_id, 'device_id' => $this['id']])
            ->first())) 
        {
            return true;
        }
        return false;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
