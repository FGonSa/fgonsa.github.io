
@extends('Plantilla.principal')


@section('titulo', 'Ciclos')


@section('contenido')
<?php
$mensaje = session()->get('mensaje');
?>
@if (isset($mensaje))
<div class="alert alert-success text-center mt-3" role="alert">
    Ciclo registrado con éxito.
</div>
{{ $mensaje = session()->forget('mensaje'); }}
@endif

    @if (empty($ciclos))
        <div class="alert alert-danger text-center mt-3" role="alert">
            No existen ciclos registrados.
        </div>
    @else

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Siglas</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($ciclos as $ciclo)
                    <tr>
                        <td >{{ $ciclo->getId() }}</td>
                        <td >{{ $ciclo->getSiglas() }}</td>
                        <td >{{ $ciclo->getNombre() }}</td>
                        <td class="col-2 text-center">
                            <form action="{{ action([App\Http\Controllers\CicloController::class, 'destroy'], [$ciclo->getId()]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="/ABP_FrankSantos/public/ciclos/create" class="add btn btn-primary position-fixed" role="button" aria-pressed="true">
        <i class="fas fa-plus"></i>
        Añadir Ciclo
    </a>
@endsection
