<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    
    protected $table = 'services';
    
    protected $fillable = [
        'name',
        'title',
        'content',
        'image_one',
        'image_two',
        'image_three'
    ];
}
