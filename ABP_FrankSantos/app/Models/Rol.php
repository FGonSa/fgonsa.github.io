<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'rols';
    //Por defecto ya vienen estos valores
    // protected $primary_key = 'id';
    // public $incrementing = true;
    public $timestamps = false;//debemos indicar a Eloquent que no tenemos timestamps
    /**
     * Get all of the usuarios fl
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'rols_id');
    }
}
