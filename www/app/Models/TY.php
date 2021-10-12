<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TY extends Model
{
    use HasFactory;

    protected $table = 'TY';

    public function controlledPoint()
    {
        return $this->belongsTo(ControlledPoint::class, 'cp-code', 'code');
    }
}
