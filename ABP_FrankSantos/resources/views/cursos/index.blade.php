<?php
function tituloCiclo($id){
switch($id){
    case 1: return "Desenvolupament Aplicacions Web";
    break;
    case 2: return "Desenvolupament Aplicacions Multiplataforma";
    break;
    case 3: return "Màrqueting i Publicitat";
    break;
    case 4: return "Administració i Finances";
    break;
    case 5: return "Agencia de Viatges i Esdeveniments";
    break;
    case 6: return "Assistència a la Direcció";
    break;
    case 7: return "Gestió Administrativa";
    break;
    case 8: return "Activitats Comercials";
    break;
    case 9: return "Comerç Internacional";
    break;
    case 10: return "Sistemes Micorinformàtics i Xarxes";
    break;
}
}
?>

@extends('Plantilla.principal')

@section('title','Cursos')

@section('contenido')

@include('partials.mensajes')

<br>
<div class="card">

    <div class="card-body">
        <h5 class="card-title">Buscar</h5>
        <form class="row gx-3 gy-2 align-items-center" action="{{ action([App\Http\Controllers\CursoController::class, 'index']) }}">
                @csrf
            <div class="col-1">
              <label  for="ciclosLabel">Ciclos</label>
            </div>

            <div class="col-sm-9">
              <select class="form-select" id="specificSizeSelect">
                <option selected>Todos los Ciclos</option>
                @foreach ($ciclos as $ciclo)
                    <option>{{ $ciclo->nom }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-auto">
                @if (old('actiuBuscar') == 'actiu')
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="actiuBuscar" value="actiu" name='actiuBuscar' checked>
                    <label class="form-check-label" for="actiuBuscar">
                      Activo
                    </label>
                  </div>
                @else
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="actiuBuscar" value="actiu" name='actiuBuscar'>
                    <label class="form-check-label" for="actiuBuscar">
                      Activo
                    </label>
                  </div>
                @endif

            </div>
            <div class="col-auto">
              <button type="submit" name="buscar" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
            </div>
          </form>

    </div>
  </div>

  <br>
  @if (empty($cursos))
  <div class="alert alert-danger text-center mt-3" role="alert">
      No existen cursos registrados.
  </div>
@else
  <div class="card">
    <h4 class="card-header">
        Cursos
      </h4>
    <div class="card-body">
        <table class="table text-center" >
            <thead>
              <tr>
                <th scope="col">Siglas</th>
                <th scope="col">Nombre</th>
                <th scope="col">Ciclo</th>
                <th scope="col">Activo</th>
                <th scope="col"></th>
              </tr>
            </thead>
            @foreach ($cursos as $curso)
<tr>
    <td>{{ $curso->sigles }}</td>
    <td>{{ $curso->nom }}</td>
    <td>{{ tituloCiclo($curso->cicles_id )}}</td>
    <td>
        @if ($curso->actiu)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="actiu" name="actiu" value="actiu" checked disabled>
                <label class="custom-control-label" for="actiu"></label>
            </div>
            @else
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="actiu" name="actiu" value="actiu" disabled>
                <label class="custom-control-label" for="actiu"></label>
            </div>
        @endif
        </td>
    <td>
        <form action="{{ action([App\Http\Controllers\CursoController::class, 'edit'], ['curso' => $curso->id]) }}" method="POST">
            @csrf
            @method('GET')
            <button type="submit" class="float-start btn btn-secondary m-1"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
        </form>
       <div>
        <button type="submit" class="float-start btn btn-danger m-1 btn-eliminar" data-bs-toggle="modal" data-bs-target="#exampleModal" data-sigla="{{ $curso->sigles }}" data-action="{{ action([App\Http\Controllers\CursoController::class,'destroy'],['curso'=>$curso->id]) }}"><i class=" fa-solid fa-trash-can" ></i> Eliminar</button>
       </div>
    </td>
</tr>
            @endforeach
            @endif


            <tbody>
          </table>
          <a href="{{ url('cursos/create') }}" class="float-end add btn btn-dark" role="button" aria-pressed="true">
            <i class="fas fa-plus"></i>
            Añadir Curso
        </a>
          {{ $cursos->links() }}
    </div>
  </div>

   {{-- Modal --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Curso</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="bodyModal"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form id="modalFormCurso" action="{{ action([App\Http\Controllers\CursoController::class, 'destroy'], ['curso' => $curso->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection

