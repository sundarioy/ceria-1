<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'description',
        'location'
    ];

    public function eventKelas() {
        $this->hasMany('App\Models\KelasEvent', 'id_event');
    }
}
