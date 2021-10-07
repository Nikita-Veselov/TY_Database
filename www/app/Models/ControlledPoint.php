<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlledPoint extends Model
{
    use HasFactory;

    protected $table = 'controlled_points';

    public $timestamps = false;

    protected $fillable = ['code', 'name', 'type'];
}
