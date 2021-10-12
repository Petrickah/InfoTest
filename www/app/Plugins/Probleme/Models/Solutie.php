<?php

namespace App\Plugins\Probleme\Models;

use Illuminate\Database\Eloquent\Model;

class Solutie extends Model{
    protected $table = 'solutii';
    protected $primaryKey = 'ID';
    protected $keyType = 'integer';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['score', 'utilizator', 'problema'];

    public function user() {
        return $this->belongsTo(\App\Models\User::class, 'utilizator');
    }

    public function probleme() {
        return $this->belongsTo(\App\Plugins\Probleme\Models\Probleme::class, 'problema');
    }
}