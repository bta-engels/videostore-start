<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::whereEmail($request->email)->first();
        // wenn login nicht erfolgreich
        if ( ! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Login Daten sind nicht korrekt.'],
            ]);
        }
        // generiere Auth Token
        $tokenName = $user->email . '-' . uniqid();
        $token = $user->createToken($tokenName, ['todo-write'])->plainTextToken;
        // json rückgabe: name, email, token
        $response = [
            'name'  => $user->name,
            'email'  => $user->email,
            'token'  => $token,
        ];

        return response()->json($response);
    }
}
