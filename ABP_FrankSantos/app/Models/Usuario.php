<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuaris';
    //Por defecto ya vienen estos valores
    // protected $primary_key = 'id';
    // public $incrementing = true;
    public $timestamps = false;//debemos indicar a Eloquent que no tenemos timestamps
    /**
     * Get the roles te Usuario
     *
     * @return \Illuminate\Dbase\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsTo(Rol::class, 'rols_id');
    }

    /**
     * The usuaris_has_competencies_detall that belong to the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competencies_detall()
    {
        return $this->belongsToMany(Competencias_Detalle::class, 'usuaris_has_competencies_detall', 'usuaris_id', 'competencies_detall_id')->withPivot('curs_academic_id','nivell');
    }

    /**
     * The moduls_has_professors that belong to the Usuario
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'moduls_has_professors', 'usuaris_id', 'moduls_id')->withPivot('curs_academic_id');
    }
}
