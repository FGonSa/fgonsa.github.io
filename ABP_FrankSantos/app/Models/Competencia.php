<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    use HasFactory;
    protected $table = 'competetencies';
    //Por defecto ya vienen estos valores
    // protected $primary_key = 'id';
    // public $incrementing = true;
    public $timestamps = false;//debemos indicar a Eloquent que no tenemos timestamps
    /**
     * Get the modulos that owns the Competencia
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modulos()
    {
        return $this->belongsTo(Modulo::class, 'moduls_id');
    }
}
