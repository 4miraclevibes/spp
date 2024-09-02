<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'spp_student_id',
        'user_id',
        'status',
        'image',
        'message',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function sppStudent(){
        return $this->belongsTo(SppStudent::class);
    }
}
