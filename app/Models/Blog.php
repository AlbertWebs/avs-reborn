<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    
    protected $table = 'blogs';
    
    protected $fillable = [
        'title',
        'link',
        'content',
        'author',
        'category',
        'cat',
        'image_one',
        'image_two',
        'image_three',
        'image_four',
        'slung'
    ];
}
