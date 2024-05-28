<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();

        $data = [
            "teachers"=> $teachers,
            "status" => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:255',
            'email'=> 'required|email|unique:teachers',
            'course'=> 'required|max:255',
            'phone'=> 'required|digits:9',
            'language'=> 'required|in:English,Spanish,French',
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response() ->json($data, 400);
        }

        $teacher = Teacher::create([
            'name' => $request->name,
            'email'=> $request->email,
            'course'=> $request->course,
            'phone'=> $request->phone,
            'language'=> $request->language,
        ]);

        if(!$teacher) {
            $data = [
                'message' => 'Error al crear el profesor',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'teacher' => $teacher,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'teacher'=> $teacher,
            'status'=> 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:255',
            'email'=> 'required|email|unique:teachers,email,'.$id,
            'course'=> 'required|max:255',
            'phone'=> 'required|digits:9',
            'language'=> 'required|in:English,Spanish,French',
        ]);

        if($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response() ->json($data, 400);
        }

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->course = $request->course;
        $teacher->language = $request->language;
        $teacher->save();

        $data = [
            'message' => 'Profesor actualizado',
            'teacher' => $teacher,
            'status' => 201
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if(!$teacher) {
            $data = [
                'message' => 'Profesor no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $teacher->delete();

        $data = [
            'message' => 'Profesor eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
