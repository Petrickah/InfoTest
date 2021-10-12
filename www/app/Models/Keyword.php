<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static Keyword find($word)
 * @method static Keyword create(array $array)
 * @property string Keyword
 * @property string Postare
 */
class Keyword extends Model
{
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'keywords';
    protected $primaryKey = 'Keyword';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['Postare', 'Keyword'];

    public function postari() {
        return $this->belongsTo(Postare::class, "Postare");
    }
    public function categorie() {
        return $this->belongsToMany('App\Models\Categorie');
    }
}
