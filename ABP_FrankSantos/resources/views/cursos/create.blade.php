
@extends('Plantilla.principal')

@section('titulo', 'Añadir Curso')

@section('contenido')

@include('partials.mensajes')
<?php
$i= 1;
?>
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
                <input type="text" class="form-control" id="nom" name="nom" value="{{ old('sigla') }}">
        </div>
                <div class="col-1">
                    <label  for="ciclosLabel">Ciclo</label>
                  </div>

                  <div class="col-sm-11">
                    <select class="form-select" id="selectCiclo" name="selectCiclo">
                      @foreach ($ciclos as $ciclo)

                    <option value = "{{ $i }}">{{ $ciclo->nom }}</option>
<?php $i++; ?>
                @endforeach
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
                  <div class="form-group-row">
                    <div class="col-sm-12">
                        <a  class="button float-end btn btn-secondary" href="{{ url('cursos') }}"><i class="fa-solid fa-xmark"></i> Cancelar</a>
                        <button type="submit" class="float-end btn btn-dark me-1"><i class="fa-solid fa-check"></i> Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
