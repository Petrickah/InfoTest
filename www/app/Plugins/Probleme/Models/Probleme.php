<?php

namespace App\Plugins\Probleme\Models;

use Illuminate\Database\Eloquent\Model;

class Probleme extends Model{
    protected $table = 'probleme';
    protected $primaryKey = 'nume';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['nume', 'location', 'slug', 'thumbnail'];

    public function postare() {
        return $this->hasOne(\App\Models\Postare::class, 'slug');
    }

    public function solutii() {
        return $this->hasMany(\App\Plugins\Probleme\Models\Solutie::class, 'problema');
    }
}