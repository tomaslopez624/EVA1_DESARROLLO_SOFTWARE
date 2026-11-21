<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Busca el token en el encabezado Authorization (Bearer) o en la sesión
        $token = $request->bearerToken() ?? session('jwt_token');

        if (!$token) {
            return $this->noAutorizado($request, 'Token JWT no proporcionado.');
        }

        $partes = explode('.', $token);
        if (count($partes) !== 3) {
            return $this->noAutorizado($request, 'Formato de token JWT inválido.');
        }

        [$header, $payload, $signature] = $partes;
        $secret = env('APP_KEY', 'clave_secreta_tech_solutions');

        // Recalcula la firma para verificar que el token no fue alterado
        $firmaEsperada = rtrim(strtr(base64_encode(
            hash_hmac('sha256', "$header.$payload", $secret, true)
        ), '+/', '-_'), '=');

        if (!hash_equals($firmaEsperada, $signature)) {
            return $this->noAutorizado($request, 'Firma del token JWT inválida.');
        }

        // Verifica que el token no haya expirado
        $datosPayload = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
        if (!$datosPayload || (isset($datosPayload['exp']) && $datosPayload['exp'] < time())) {
            return $this->noAutorizado($request, 'El token JWT ha expirado.');
        }

        return $next($request);
    }

    private function noAutorizado(Request $request, string $mensaje)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => $mensaje], 401);
        }

        return redirect()->route('login.form')->withErrors(['auth' => $mensaje]);
    }
}