
@extends('Plantilla.principal')

@section('titulo', 'Añadir Curso')

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
            Curso
        </div>
        <div class="card-body">
            <form  class="row gx-3 gy-2 align-items-center" action="{{ action([App\Http\Controllers\CursoController::class, 'store']) }}" method="POST">
                @csrf
                <div class="col-1">
                    <label  for="ciclosLabel">Siglas</label>
                  </div>

            <div  class="col-sm-11">
                    <input type="text" class="form-control" id="sigla" name="sigla" value="{{ old('sigla') }}">
            </div>

            <div class="col-1">
                <label  for="ciclosLabel">Nombre</label>
              </div>

        <div  class="col-sm-11">
                <input type="text" class="form-control" id="sigla" name="sigla" value="{{ old('sigla') }}">
        </div>
                <div class="col-1">
                    <label  for="ciclosLabel">Ciclo</label>
                  </div>

                  <div class="col-sm-11">
                    <select class="form-select" id="specificSizeSelect">
                      <option selected>Todos los Ciclos</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>

                  <div class="col-1">
                    <label  for="ciclosLabel">Activo</label>
                  </div>

                  <div class="col-sm-1">
                      @if (old('actiuBuscar') == 'actiu')
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="actiuBuscar" value="actiu" name='actiuBuscar' checked>
                          <label class="form-check-label" for="actiuBuscar">
                          </label>
                        </div>
                      @else
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="actiuBuscar" value="actiu" name='actiuBuscar'>
                          <label class="form-check-label" for="actiuBuscar">
                          </label>
                        </div>
                      @endif
                  </div>
            </form>
            <form action="">
                <button type="submit" class="float-end btn btn-secondary"><i class="fa-solid fa-xmark"></i> Cancelar</button>
            </form>
            <form action="">
                <button type="submit" class="float-end btn btn-dark me-1"><i class="fa-solid fa-check"></i> Aceptar</button>
            </form>
        </div>
    </div>
@endsection
