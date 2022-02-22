
@extends('Plantilla.principal')

@section('titulo', 'Añadir Curso')

@section('contenido')

@include('partials.mensajes')

    <div class="card mt-3">
        <div class="card-header fs-4 d-flex align-items-center bg-dark" style="color: white;">
            Curso
        </div>
        <div class="card-body">
            <form  class="row gx-3 gy-2 align-items-center" action="{{ action([App\Http\Controllers\CursoController::class, 'update']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-1">
                    <label  for="ciclosLabel">Siglas</label>
                  </div>

            <div  class="col-sm-11">
                    <input type="text" class="form-control" id="sigla" name="sigla" value="{{ $curso->sigles }}">
            </div>

            <div class="col-1">
                <label  for="ciclosLabel">Nombre</label>
              </div>

        <div  class="col-sm-11">
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $curso->nom }}">
        </div>
                <div class="col-1">
                    <label  for="ciclosLabel">Ciclo</label>
                  </div>

                  <div class="col-sm-11">
                    <select class="form-select" id="selectCiclo" name="selectCiclo">
                      <option selected value="{{ $curso->cicles_id }}">Todos los Ciclos</option>
                      <option value="{{ $curso->cicles_id }}">One</option>
                      <option value="{{ $curso->cicles_id }}">Two</option>
                      <option value="{{ $curso->cicles_id }}">Three</option>
                    </select>
                  </div>

                  <div class="col-1">
                    <label  for="ciclosLabel">Activo</label>
                  </div>

                  <div class="col-sm-1">
                      @if (old('actiuBuscar') == 'actiu')
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="actiuBuscar" value="{{ $curso->actiu }}" name='actiuBuscar' checked>
                          <label class="form-check-label" for="actiuBuscar">
                          </label>
                        </div>
                      @else
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="actiuBuscar" value="{{ $curso->actiu }}" name='actiuBuscar'>
                          <label class="form-check-label" for="actiuBuscar">
                          </label>
                        </div>
                      @endif
                  </div>
                  <div class="form-group-row">
                    <div class="col-sm-12">
                        <a  class="button float-end btn btn-secondary" href="{{ url('cursos') }}><i class="fa-solid fa-xmark"></i> Cancelar</button>
                        <button type="submit" class="float-end btn btn-dark me-1"><i class="fa-solid fa-check"></i> Aceptar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection