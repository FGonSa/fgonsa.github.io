<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Curso;
use App\Classes\Utilitat;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

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
        $categoria = $request->input('categoria');
        $ciclos = Ciclo::where('id', '>',0)->get();

        if (empty($categoria)) {
            if ($actiu == 'actiu') {
                $cursos = Curso::where('actiu', true)->paginate(6)->withQueryString();
            } else {
                $cursos = Curso::paginate(6);
            }
        } else {
            if ($actiu == 'actiu') {
                $cursos = Curso::where('actiu', true)->where('cicles_id', $categoria)->paginate(6)->withQueryString();
            } else {
                $cursos = Curso::where('cicles_id', $categoria)->paginate(6);
            }
        }
        $resultados = count($cursos);
        $request->session()->flashInput($request->input());
        return view('cursos.index', compact('cursos', 'ciclos', 'resultados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciclos = Ciclo::where('id', '>', 0)->get();
        return view('cursos.create', compact('ciclos'));
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
            $request->session()->flash('mensaje', 'Curso creado correctamente.');
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
        $ciclos = Ciclo::where('id', '>', 0)->get();
        return view('cursos.edit', compact('curso', 'ciclos'));
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
        $curso->sigles = $request->input('sigla');
        $curso->nom = $request->input('nom');
        $curso->cicles_id = $request->input('selectCiclo');
        $curso->actiu = ($request->input('actiuBuscar') == 'actiu');

        try {
            $curso->update();
            $request->session()->flash('mensaje', 'Curso modificado correctamente.');
            $response = redirect()->action([CursoController::class, 'index']);
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $request->session()->flash('error', $mensaje);
            $response = redirect()->action([CursoController::class, 'edit'], ['curso' => $curso->id])->withInput();
        }

        return $response;
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
