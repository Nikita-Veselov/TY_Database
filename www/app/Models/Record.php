<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $table = 'records';

    public function controlledPoint()
    {
        return $this->belongsTo(ControlledPoint::class, 'controlledPoint', 'code');
    }

    protected $fillable = [
        "number",
        "type",
        "date",
        "controlledPoint",
        "device",
        "UTY",
        "UTC",
        "UTP",
        "worker1",
        "worker2",
        "conclusion",
    ];
}
