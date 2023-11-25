<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
    //
    public function index(Request $request)
    {
        $notas = Nota::with("user")->get();
        return response()->json([
            "notas" => $notas
        ]);
    }

    public function store(Request $request)
    {
        /*
        $request->validate(
            [
                "titulo.required" => "Usted debe ingresar un titulo",
                "descripcion.required" => "Usted debe ingresar una descripcion",
            ],
        );
        */

        $validator = Validator::make(
            $request->all(),
            [
                'titulo' => 'required',
                'descripcion' => 'required',
            ],
            [
                "titulo.required" => "Usted debe ingresar un titulo",
                "descripcion.required" => "Usted debe ingresar una descripcion",
            ]
        );

        if ($validator->fails()) return response()->json([
            "errors" => $validator->errors()
        ]);

        $titulo = $request->titulo;
        $descripcion = $request->descripcion;

        $user = Auth::user();

        $nota = (isset($request->id)) ? Nota::where('id', $request->id)->first() : new Nota();
        $nota->user_id = $user->id;
        $nota->title = $titulo;
        $nota->descripcion = $descripcion;
        $nota->fecha = Carbon::now()->format("d/m/y");
        $nota->save();

        return response()->json([
            "notifications" => [
                [
                    "type" => "success",
                    "message" => "Nota guardada!"
                ],
            ]
        ]);
    }

    public function delete(Request $request)
    {
        $delete_ids = $request->delete_ids;
        $notas = Nota::whereIn("id", $delete_ids)->get();
        foreach ($notas as $nota) {
            $nota->delete();
        }
        return response()->json([
            "notifications" => [
                [
                    "type" => "success",
                    "message" => "Notas eliminadas!"
                ],
            ]
        ]);
    }
}
