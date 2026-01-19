<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    
    const PAYMENT_COMPLETED = 1;
    const PAYMENT_PENDING = 0;

    protected $table = 'orders';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'total',
        'content',
        'status',
        'transaction_id',
        'amount',
        'payment_status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
