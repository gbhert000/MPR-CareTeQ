<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class u_hispatient extends Model
{
    use HasFactory;

    protected $table ='u_hispatients';
    protected $fillable = [
        'CODE',
        'U_FIRSTNAME',
        'U_MIDDLENAME',
        'U_LASTNAME',
    ];
    public $timestamps = false;
}
