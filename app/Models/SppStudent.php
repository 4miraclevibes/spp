<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppStudent extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade_id',
        'student_id',
        'user_id',
        'tanggal',
        'via',
        'bulan',
        'status',
        'price',
        'tahun',
        'tahun_ajaran',
        'payment_proof',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
