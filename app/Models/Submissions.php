<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_assignment', 
        'id_student', 
        'file', 
        'path', 
    ];
}
