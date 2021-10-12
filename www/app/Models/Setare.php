<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setare extends Model {
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $timestamps: Nu foloseste timestamps
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'setari';
    protected $primaryKey = 'Obtiune';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

}
