<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'grade_id',
        'student_parent_id',
        'ta_student_id',
        'student_fee_id',
        'nis',
        'nisn',
        'nik',
        'name',
        'status',
        'discount',
    ];
   
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
   
    public function studentParent(){
        return $this->belongsTo(StudentParent::class);
    }
   
    public function taStudent(){
        return $this->belongsTo(TaStudent::class);
    }
   
    public function sppStudents(){
        return $this->hasMany(SppStudent::class);
    }
   
    public function studentFee(){
        return $this->belongsTo(StudentFee::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
