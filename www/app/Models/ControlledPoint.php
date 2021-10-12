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

    public function ty()
    {
        return $this->hasMany(TY::class, 'cp-code', 'code');
    }
    public function tc()
    {
        return $this->hasMany(TC::class, 'cp-code', 'code');
    }
}
