<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    use HasFactory;
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $fillable = ['name' , 'batch_id' , 'student_id' , 'join_date' , 'fee'];

    public function student()
    {
        return $this->belongsTo(students::class);
    }
    public function batch()
    {
        return $this->belongsTo(batch::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    
}
