<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'amount',
        'status',
        'payment_method',
        'payment_proof',
    ];
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
