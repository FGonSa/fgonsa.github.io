<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;
    protected $table = 'moduls';
    //Por defecto ya vienen estos valores
    // protected $primary_key = 'id';
    // public $incrementing = true;
    public $timestamps = false;//debemos indicar a Eloquent que no tenemos timestamps

    /**
     * Get the ciclo that owns the Curso
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'cicles_id');
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'moduls_has_cursos', 'moduls_id','cursos_id')->withPivot('curs_academic_id');
    }

    public function competencias()
    {
        return $this->hasMany(Competencia::class, 'moduls_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'moduls_has_professors', 'moduls_id','usuaris_id')->withPivot('curs_academic_id');
    }
}
