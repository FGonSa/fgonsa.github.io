<?php

namespace App\Http\Controllers;

use App\Classes\Utilitat;
use App\Models\Curso;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $actiu = $request->input('actiuBuscar');

        if ($actiu == 'actiu') {
            $cursos = Curso::where('actiu', '=', true)->paginate(6)->withQueryString();
        } else {
            $cursos = Curso::paginate(6);
        }
        $request->session()->flashInput($request->input());
        return view('cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso = new Curso();

        $curso->sigles = $request->input('sigla');
        $curso->nom = $request->input('nom');
        $curso->cicles_id = $request->input('selectCiclo');
        $curso->actiu = ($request->input('actiuBuscar') == 'actiu');

        try {
            $curso->save();
            $response = redirect()->action([CursoController::class, 'index']);
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $request->session()->flash('error', $mensaje);
            $response = redirect()->action([CursoController::class, 'create'])->withInput();
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function show(Curso $curso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function edit(Curso $curso)
    {
        $curso = Curso::findOrFail($curso->edit);
        return view('cursos.edit', compact('cursos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso $curso)
    {
        Curso::where('id', '=', $curso->id)->update($request);
        return redirect()->action([CursoController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso  $curso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Curso $curso)
    {
        try {
            $curso->delete();
            $request->session()->flash('mensaje', 'Registro eliminado correctamente.');
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $request->session()->flash('error', $mensaje);
        }

        return redirect()->action([CursoController::class, 'index']);
    }
}
