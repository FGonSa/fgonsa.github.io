<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencias_Detalle extends Model
{
    use HasFactory;
    protected $table = 'competencies_detall';
    //Por defecto ya vienen estos valores
    // protected $primary_key = 'id';
    // public $incrementing = true;
    public $timestamps = false;//debemos indicar a Eloquent que no tenemos timestamps
    /**
     * Get the competencias that owns the Competencias_Detalle
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competencias()
    {
        return $this->belongsTo(Competencia::class, 'competencies_id');
    }

    public function competencies_detall()
    {
        return $this->belongsToMany(Competencias_Detalle::class, 'usuaris_has_competencies_detall', 'competencies_detall_id','usuaris_id')->withPivot('curs_academic_id','nivell');
    }
}
