<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resultado;
use Illuminate\Support\Facades\Validator;

class resultadoController extends Controller
{
    //función para almacenar un nuevo resultado a la base de datos
    public function store(Request $request){
        //valida que request reciba todos los datos necesarios para crear el objeto
        $validator = Validator::make($request->all(),[
            'id_partido' => 'required',
            'goles_equipo1' => 'required',
            'goles_equipo2' => 'required'
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        //intenta crear el resultado, si existe error retorna mensaje con el error ocurrido
        try {
            $resultado = Resultado::create([
                'id_partido' => $request->id_partido,
                'goles_equipo1' => $request->goles_equipo1,
                'goles_equipo2' => $request->goles_equipo2,
            ]);
        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el resultado'.$e->getMessage(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        //si se crea el objeto, se retorna en formato json
        $data = [
            'resultado' => $resultado,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    //función para mostrar todos los resultados almacenados en la base de datos, si no hay, retorna vacío
    public function index(){
        $resultados = Resultado::all();
        $data = [
            'resultados' => $resultados,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para mostrar un resultado según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function show($id){
        $resultado = Resultado::find($id);
        if(!$resultado){
            $data = [
                'message' => 'Resultado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'resultado' => $resultado,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para eliminar un resultado, según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function destroy($id){
        $resultado = Resultado::find($id);
        if(!$resultado){
            $data = [
                'message' => 'Resultado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $resultado->delete();
        $data = [
            'message' => 'Resultado eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para modificar un resultado especificado por id ingresado
    //si no existe, se retorna el mensaje de advertencia, si no se ingresan los datos necesarios no se puede modificar
    public function update(Request $request, $id){
        $resultado = Resultado::find($id);
        if(!$resultado){
            $data = [
                'message' => 'Resultado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(),[
            'id_partido' => 'required',
            'goles_equipo1' => 'required',
            'goles_equipo2' => 'required'
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $resultado->goles_equipo1 = $request->goles_equipo1;
        $resultado->goles_equipo2 = $request->goles_equipo2;
        $resultado->id_partido = $request->id_partido;
        $resultado->save();
        $data = [
            'message' => 'Resultado actualizado',
            'resultado' => $resultado,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}