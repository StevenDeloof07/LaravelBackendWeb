<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Form extends Model
{
    /** @use HasFactory<\Database\Factories\formFactory> */
    use HasFactory, Notifiable;
    //
    //

    protected $fillable = [
        "user_email",
        "question"
    ];
    
}
