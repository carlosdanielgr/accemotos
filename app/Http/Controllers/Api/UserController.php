<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private function userValidation($id)
    {
        $user = User::find($id);
        if (!$user) {
            return [
                "message" => "Usuario no encontrado",
                "status" => false,
                "code" => Response::HTTP_NOT_FOUND
            ];
        }
        return [
            "data" =>  $user,
            "status" => true,
            "code" => Response::HTTP_OK
        ];
    }

    public function show($id)
    {
        return response()->json($this->userValidation($id));
    }

    public function update(Request $request, $id)
    {
        $foundUser = $this->userValidation($id);
        if (!$foundUser["status"]) {
            return $foundUser;
        }
        $request->validate([
            'email' => 'email|unique:users',
        ]);

        $user = $foundUser["data"];
        if ($request->name)
            $user->name = $request->name;
        if ($request->email)
            $user->email = $request->email;
        if ($request->phone)
            $user->phone = $request->phone;
        if ($request->address)
            $user->address = $request->address;
        $user->save();
        return response("¡Usuario actualizado con éxito!", Response::HTTP_OK);
    }
}
