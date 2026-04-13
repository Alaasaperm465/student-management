<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'syllabus', 'duration','price'];

    public function duration()
    {
        return $this->duration.' weeks';
    }
    public function price()
    {
        return $this->price.' $';
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollments::class);
    }

}
