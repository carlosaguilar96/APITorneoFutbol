<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partido;
use Illuminate\Support\Facades\Validator;

class partidoController extends Controller
{
    //función para almacenar un nuevo partido a la base de datos
    public function store(Request $request){
        //valida que request reciba todos los datos necesarios para crear el objeto
        $validator = Validator::make($request->all(),[
            'id_equipo1' => 'required',
            'id_equipo2' => 'required'
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        //intenta crear el partido, si existe error retorna mensaje con el error ocurrido
        try {
            $partido = Partido::create([
                'id_equipo1' => $request->id_equipo1,
                'id_equipo2' => $request->id_equipo2,
            ]);
        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el partido'.$e->getMessage(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        //si se crea el objeto, se retorna en formato json
        $data = [
            'partido' => $partido,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    //función para mostrar todos los partidos almacenados en la base de datos, si no hay, retorna vacío
    public function index(){
        $partidos = Partido::all();
        $data = [
            'partidos' => $partidos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para mostrar un partido según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function show($id){
        $partido = Partido::find($id);
        if(!$partido){
            $data = [
                'message' => 'Partido no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'partido' => $partido,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para eliminar un partido, según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function destroy($id){
        $partido = Partido::find($id);
        if(!$partido){
            $data = [
                'message' => 'Partido no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $partido->delete();
        $data = [
            'message' => 'Partido eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para modificar un partido especificado por id ingresado
    //si no existe, se retorna el mensaje de advertencia, si no se ingresan los datos necesarios no se puede modificar
    public function update(Request $request, $id){
        $partido = Partido::find($id);
        if(!$partido){
            $data = [
                'message' => 'Partido no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(),[
            'id_equipo1' => 'required',
            'id_equipo2' => 'required'
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $partido->id_equipo1 = $request->id_equipo1;
        $partido->id_equipo2 = $request->id_equipo2;
        $partido->save();
        $data = [
            'message' => 'Partido actualizado',
            'partido' => $partido,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}