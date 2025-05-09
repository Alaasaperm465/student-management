<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = ['name' , 'address' , 'mobile'];
    

    public function enrollments()
    {
        return $this->hasMany(Enrollments::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    use HasFactory;
}

