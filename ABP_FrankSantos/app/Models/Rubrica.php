<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubrica extends Model
{
    use HasFactory;
    protected $table = 'rubriques';
    //Por defecto ya vienen estos valores
    // protected $primary_key = 'id';
    // public $incrementing = true;
    public $timestamps = false;//debemos indicar a Eloquent que no tenemos timestamps
    /**
     * Get all of the competencies_detall for the Rubrica
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competencies_detall()
    {
        return $this->belongsTo(Competencias_Detalle::class, 'competencies_detall_id');
    }
}
