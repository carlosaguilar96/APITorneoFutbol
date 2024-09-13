<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use Illuminate\Support\Facades\Validator;

class equipoController extends Controller
{
    //función para almacenar un nuevo equipo a la base de datos
    public function store(Request $request){
        //valida que request reciba todos los datos necesarios para crear el objeto
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        //intenta crear el equipo, si existe error retorna mensaje con el error ocurrido
        try {
            $equipo = Equipo::create([
                'nombre' => $request->nombre,
            ]);
        } catch (\Exception $e) {
            $data = [
                'message' => 'Error al crear el equipo'.$e->getMessage(),
                'status' => 500
            ];
            return response()->json($data, 500);
        }
        //si se crea el objeto, se retorna en formato json
        $data = [
            'equipo' => $equipo,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    //función para mostrar todos los equipos almacenados en la base de datos, si no hay, retorna vacío
    public function index(){
        $equipos = Equipo::all();
        $data = [
            'equipos' => $equipos,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para mostrar un equipo según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function show($id){
        $equipo = Equipo::find($id);
        if(!$equipo){
            $data = [
                'message' => 'Equipo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'equipo' => $equipo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para eliminar un equipo, según id ingresado, si no existe, se retorna el mensaje de advertencia
    public function destroy($id){
        $equipo = Equipo::find($id);
        if(!$equipo){
            $data = [
                'message' => 'Equipo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $equipo->delete();
        $data = [
            'message' => 'Equipo eliminado',
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    //función para modificar un equipo especificado por id ingresado
    //si no existe, se retorna el mensaje de advertencia, si no se ingresan los datos necesarios no se puede modificar
    public function update(Request $request, $id){
        $equipo = Equipo::find($id);
        if(!$equipo){
            $data = [
                'message' => 'Equipo no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
        ]);
        if ($validator->fails()){
            $data = [
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $equipo->nombre = $request->nombre;
        $equipo->save();
        $data = [
            'message' => 'Equipo actualizado',
            'equipo' => $equipo,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
