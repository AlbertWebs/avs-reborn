<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'number',
        'invoice_number',
        'shipping',
        'products',
        'user_id',
        'amount',
        'status'
    ];
    
    protected $casts = [
        'amount' => 'decimal:2',
        'shipping' => 'decimal:2',
        'status' => 'integer'
    ];
}
