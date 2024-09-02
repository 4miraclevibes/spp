<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'fee_id',
        'user_id',
        'status',
        'amount',
    ];

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentDetails()
    {
        return $this->hasMany(PaymentDetail::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
    