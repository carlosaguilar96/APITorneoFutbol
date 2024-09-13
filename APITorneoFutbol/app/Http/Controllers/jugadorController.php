<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;
use Illuminate\Support\Facades\Validator;

class jugadorController extends Controller
{
    //función para almacenar un nuevo jugador a la base de datos
    public function store(Request $request){
        //valida que request reciba todos los datos necesarios para crear el objeto
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'posicion' => 'required',
            'id_equipo' => 'required'
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        //intenta crear el jugador, si existe error retorna mensaje con el error ocurrido
        try {
            $jugador = Jugador::create([
                'nombre' => $request->nombre,
                'posicion' => $request->posicion,
                'id_equipo' => $request->id_equipo
            ]);
        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el jugador'.$e->getMessage(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        //si se crea el objeto, se retorna en formato json
        $data = [
            'jugador' => $jugador,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    //función para mostrar todos los jugadores almacenados en la base de datos, si no hay, retorna vacío
    public function index(){
        $jugadores = Jugador::all();
        $data = [
            'jugadores' => $jugadores,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para mostrar un jugador según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function show($id){
        $jugador = Jugador::find($id);
        if(!$jugador){
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'jugador' => $jugador,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para eliminar un jugador, según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function destroy($id){
        $jugador = Jugador::find($id);
        if(!$jugador){
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $jugador->delete();
        $data = [
            'message' => 'Jugador eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para modificar un jugador especificado por id ingresado
    //si no existe, se retorna el mensaje de advertencia, si no se ingresan los datos necesarios no se puede modificar
    public function update(Request $request, $id){
        $jugador = Jugador::find($id);
        if(!$jugador){
            $data = [
                'message' => 'Jugador no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'posicion' => 'required',
            'id_equipo' => 'required'
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $jugador->nombre = $request->nombre;
        $jugador->posicion = $request->posicion;
        $jugador->id_equipo = $request->id_equipo;
        $jugador->save();
        $data = [
            'message' => 'Jugador actualizado',
            'jugador' => $jugador,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
