<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    // Muestra la vista de Registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Procesa el Registro de Usuario con cifrado de clave
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email',
            'clave' => 'required|string|min:6',
        ]);

        // Cifrado de la contraseña antes de almacenarla
        $claveCifrada = Hash::make($request->clave);

        $nuevoUsuario = [
            'id' => rand(2, 999),
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'clave' => $claveCifrada,
        ];

        // Guardamos en sesión para simular persistencia junto a los datos estáticos
        $usuariosRegistrados = session('usuarios_registrados', []);
        $usuariosRegistrados[] = $nuevoUsuario;
        session(['usuarios_registrados' => $usuariosRegistrados]);

        if ($request->expectsJson()) {
            return response()->json([
                'mensaje' => 'Usuario registrado correctamente.',
                'usuario' => [
                    'id' => $nuevoUsuario['id'],
                    'nombre' => $nuevoUsuario['nombre'],
                    'correo' => $nuevoUsuario['correo'],
                    'clave_cifrada' => $nuevoUsuario['clave'],
                ],
            ], 201);
        }

        return redirect()->route('login.form')->with('success', 'Usuario registrado con clave cifrada. Ahora puedes iniciar sesión.');
    }

    // Muestra la vista de Inicio de Sesión
    public function showLogin()
    {
        return view('auth.login');
    }

    // Procesa el Inicio de Sesión y devuelve un JWT
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required|string',
        ]);

        // Combinamos los usuarios estáticos del modelo con los registrados en sesión
        $usuarios = Usuario::obtenerDatosEstaticos()->merge(session('usuarios_registrados', []));
        $usuario = $usuarios->firstWhere('correo', $request->correo);

        if (!$usuario || !Hash::check($request->clave, $usuario['clave'])) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Credenciales inválidas.'], 401);
            }
            return back()->withErrors(['correo' => 'Credenciales inválidas.'])->withInput();
        }

        // Generamos el JSON Web Token (JWT)
        $token = $this->generarJwt($usuario);

        // Guardamos el token en sesión para facilitar las pruebas desde el navegador
        session(['jwt_token' => $token]);

        if ($request->expectsJson()) {
            return response()->json([
                'mensaje' => 'Inicio de sesión exitoso.',
                'token' => $token,
                'tipo' => 'Bearer',
            ]);
        }

        return redirect()->route('proyectos.index')->with('success', 'Sesión iniciada correctamente. JWT generado: ' . substr($token, 0, 30) . '...');
    }

    // Genera un JWT estándar (RFC 7519) con firma HMAC SHA256
    private function generarJwt(array $usuario): string
    {
        $header = $this->base64UrlEncode(json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT',
        ]));

        $payload = $this->base64UrlEncode(json_encode([
            'sub' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'correo' => $usuario['correo'],
            'iat' => time(),
            'exp' => time() + 3600, // Expira en 1 hora
        ]));

        $secret = env('APP_KEY', 'clave_secreta_tech_solutions');
        $signature = $this->base64UrlEncode(
            hash_hmac('sha256', "$header.$payload", $secret, true)
        );

        return "$header.$payload.$signature";
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}