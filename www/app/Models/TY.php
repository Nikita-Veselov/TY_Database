<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TY extends Model
{
    use HasFactory;

    protected $table = 'TY';

    public $timestamps = false;

    public function controlledPoint()
    {
        return $this->belongsTo(ControlledPoint::class, 'cp-code', 'code');
    }

    protected $fillable = [
        "name",
        "klemm",
        "number",
        "oper",
        "DP",
        "cp-code"
    ];
}
