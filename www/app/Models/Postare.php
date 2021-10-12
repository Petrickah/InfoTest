<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static Postare create(array $all)
 * @method static Postare find(string $postare)
 * @method static paginate(int $postari_per_page)
 * @property Categorie categorie
 * @property string slug
 * @property string Autor
 * @property string Titlu
 * @property string Categorie
 */
class Postare extends Model {
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'postari';
    protected $primaryKey = 'slug';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['Titlu', 'Continut', 'Categorie'];
    protected $guarded = ['Titlu', 'Continut', 'Categorie'];

    public function autor() {
        return $this->belongsTo('App\Models\User', 'Autor');
    }
    public function categorie() {
        return $this->belongsTo('App\Models\Categorie', 'Categorie');
    }
    public function keyword() {
        return $this->hasMany('App\Models\Keyword', 'Postare');
    }
    public function updateKeywords($keywords = null) {
        $categorie = $this->categorie;
        if(!is_null($categorie)){
            if(!empty($keywords)) {
                $listKeywords = explode(', ', $keywords);
                $newKeywords = [];
                foreach ($listKeywords as $word) {
                    $kw = Keyword::all()->where('Keyword', '=', $word);
                    if (empty($kw->all())) {
                        $kw = Keyword::create([
                            'Keyword'=>$word
                        ])->postari()->associate($this);
                        $kw->save();
                        $newKeywords[] = $kw->getKey();
                    } else {
                        $kw_postare = $kw->where('Postare', '=', $this->slug)->last();
                        if(is_null($kw_postare)) {
                            Keyword::create([
                                'Keyword'=>$word,
                            ])->postari()->associate($this)->save();
                        }
                    }
                }
                foreach($newKeywords as $new) {
                    $kw = Keyword::create([
                        'Keyword'=>Keyword::find($new)->Keyword
                    ]);
                    $kw->save();
                    $categorie->keyword()->attach($kw->getKey());
                }
                $categorie->save();
            }
        }
        return $this;
    }
}
