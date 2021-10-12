<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static Categorie create(array $all)
 * @method static Categorie find($Categorie)
 * @method static Collection paginate(int $categorii_per_page)
 * @property string Descriere
 * @property Collection keyword
 * @property string Denumire
 */
class Categorie extends Model
{
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'categorii';
    protected $primaryKey = 'Denumire';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['Denumire'];
    public $timestamps = false;

    public function postare() {
        return $this->hasMany('App\Models\Postare', 'Categorie');
    }
    public function keyword() {
        return $this->belongsToMany('App\Models\Keyword');
    }
}
