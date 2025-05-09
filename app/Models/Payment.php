<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $fillable = ['enrollment_id', 'paid_date', 'amount'];

    // This function using to make relationShip with enrollment class 
    // we must make this relation because we use $$ enrollment_id $$
    
    
    public function students()
    {
        return $this->belongsTo(students::class);
    }
    ///
    public function enrollment()
    {
        return $this->belongsTo(Enrollments::class);
    }
    
}
