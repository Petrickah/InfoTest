<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($role_role)
 */
class Role extends Model {
    /** Suprascrierea unor atribute a modelului
     * @var string $table: Nume Tabela
     * @var string $primaryKey: Cheia primara
     * @var string $keyType: Tipul acesteia
     * @var boolean $incrementing: Cheia primara nu este autoincrementabila
     */
    protected $table = 'roles';
    protected $primaryKey = 'role';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['role', 'descriere'];

    public function user() {
        return $this->belongsToMany("App\Models\User");
    }
}
