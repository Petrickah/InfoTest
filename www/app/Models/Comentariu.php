<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentariu extends Model {
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     */
    protected $table = 'comentarii';
    protected $primaryKey = 'id';
    protected $keyType = 'int';

    public function autor() {
        return $this->belongsTo('App\Models\User', 'Autor');
    }
}
