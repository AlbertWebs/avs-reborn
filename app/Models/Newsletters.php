<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model
{
    use HasFactory;
    
    protected $table = "newsletters";
    
    protected $fillable = [
        'user',
        'email',
        'ip_address',
        'status'
    ];
}
