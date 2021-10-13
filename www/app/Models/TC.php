<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TC extends Model
{
    use HasFactory;

    protected $table = 'TC';

    public $timestamps = false;

    public function controlledPoint()
    {
        return $this->belongsTo(ControlledPoint::class, 'cp-code', 'code');
    }

    protected $fillable = [
        "name",
        "klemm",
        "number",
        "invert",
        "oper",
        "DP",
        "cp-code"
    ];
}
