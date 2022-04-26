<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function majors()
    {
        return $this->hasMany(Major::class, 'head_of_major_id');
    }
}
