@extends('Plantilla.principal')

@section('title','Cursos')

@section('contenido')

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
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
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
    <td>{{ $curso->cicles_id }}</td>
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
        <form action="">
            <button type="submit" class="float-start btn btn-secondary m-1"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
        </form>
       <form action="">
        <button type="submit" class="float-start btn btn-danger m-1"><i class=" fa-solid fa-trash-can"></i> Eliminar</button>
       </form>

    </td>
</tr>
            @endforeach
            <tbody>
          </table>
          <a href="{{ url('cursos/create') }}" class="float-end add btn btn-dark" role="button" aria-pressed="true">
            <i class="fas fa-plus"></i>
            Añadir Curso
        </a>
          {{ $cursos->links() }}
    </div>
  </div>


@endsection
