
@extends('Plantilla.principal')

@section('titulo', 'Añadir Ciclo')

@section('contenido')
<?php
$error = session()->get('error');
?>
@if (isset($error))
<div class="alert alert-danger text-center mt-3" role="alert">
    Debes rellenar todos los campos.
</div>
{{ $error = session()->forget('error'); }}
@endif
    <div class="card mt-3">
        <div class="card-header fs-4 d-flex align-items-center bg-dark" style="color: white;">
            Ciclo
        </div>
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\CicloController::class, 'store']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id" class="form-label">Identificador</label>
                    <input type="number" class="form-control" id="id" name="id" value="{{ old('id') }}">
                </div>
                <div class="mb-3">
                    <label for="sigla" class="form-label">Sigla</label>
                    <input type="text" class="form-control" id="sigla" name="sigla" value="{{ old('sigla') }}">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/ABP_Frank_Santos/public/ciclos" class="btn btn-secondary" role="button" aria-pressed="true">Cancelar</a>
                    <input type="submit" class="btn btn-primary ms-2" name="insertar" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
@endsection
