<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $table = 'cursos';
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
}
