<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\ValidationException;
use Spatie\FlareClient\Http\Exceptions\NotFound;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showSelects(){

 $usersCount = User::count();
 $adultsCount = User::where("edad", ">=", 18)->count();

 return "La tabla tiene $usersCount usuarios. De esos $adultsCount son mayores de edad.";
}


    public function getAllUsers(){

        $users = User::all();
        return response()->json(['Users' => $users], 201);

    }

    public function getUser($id){
        try{
        $user = User::findOrFail($id);
        return response()->json(['User = ' => $user], 201);
        }catch(ModelNotFoundException $exception){
            return response()->json(["User: ".$id." not found   -  ".$exception],404);
        }
    }

    public function deleteUser($id){

       $temp = User::findOrFail($id);
       $user = User::findOrFail($id)->delete();
       return response()->json(["Usuario eliminado:",$temp]);}

    public function updateUser(Request $request,$id){
        try{
            $errorMessages = [
                "name.required"=>"Ingresa un nombre",
            ];

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'edad' => 'required|numeric|max:255',
                'telefono' => 'required|numeric|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:8',
                // Add other validation rules as needed
            ],$errorMessages);

            $user = User::findOrFail($id)->update([
            "name"=>$request->input("name"),
            "edad"=>$request->input("edad"),
            "telefono"=>$request->input("telefono"),
            "email"=>$request->input("email"),
            "password"=>$request->input("password")
    ])
                ;
            $message ="Usuario actualizado correctamente";
            return response()->json(['message' => $message, 'user' => $user], 201);
        }
    catch (ValidationException | ModelNotFoundException $e) {
        return response()->json(['errors' => $e->errors()], 422);

    }
}

    public function createUser(Request $request){
        try{
            $errorMessages = [
                "name.required"=>"Ingresa un nombre",
            ];
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'edad' => 'required|numeric|max:255',
            'telefono' => 'required|numeric|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            // Add other validation rules as needed
        ],$errorMessages);

        $user = new User([
        "name"=>$request->input("name"),
        "edad"=>$request->input("edad"),
        "telefono"=>$request->input("telefono"),
        "email"=>$request->input("email"),
        "password"=>$request->input("password")
        ]);
        $user->save();

        $message ="Usuario creado correctamente";
        return response()->json(['message' => $message, 'user' => $user], 201);
    }catch (ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);


    }
}}
