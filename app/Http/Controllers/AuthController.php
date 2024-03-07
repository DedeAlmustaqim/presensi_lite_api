<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function api_login(Request $request)
    {
        $credentials = $request->only('nik', 'password');
        if (Auth::guard('api')->attempt($credentials)) {
            $user = Auth::guard('api')->user();
            // $unitData = $user->unit;
            // $user = User::with('unit')->find($user->id);
            $token = $user->createToken('authToken')->plainTextToken;
            $user['token'] = $token;
            // Periksa apakah waktu login kurang dari available_login
            // Periksa apakah waktu login kurang dari available_login
            if (Carbon::now() < $user->available_login) {
                $diff = $user->available_login->diff(Carbon::now());
             
                $timeLeft = $diff->format('%h jam and %i menit');
                return response()->json([
                    'success' => false,
                    'data' => [
                        "message" => "Login di akun anda belum tersedia. Silakan coba lagi setelah  $timeLeft."
                    ]
                ], 200);
            }

            return response()->json([
                'success' => true,
                'data' => ['id' => $user['id'], 'id_unit' => $user['id_unit'], 'token' => $user['token']]
            ], 200);
        }

        return response()->json([
            'success' => false,
            'data' => [
                "message" => 'Username atau Password Salah, hubungi Admin SKPD untuk diteruskan ke Admin Pemda jika anda lupa username atau password'
            ]
        ], 200);
    }

    public function admin_login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            $user = Auth::guard('web')->user();

            $token = $user->createToken('authToken')->plainTextToken;
            $user['token'] = $token;

            return response()->json([
                'success' => true,
                'data' => $user
            ], 200);
        }

        return response()->json([
            'success' => false,
            'data' => [
                "message" => 'Wrong email or password'
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        // Tambahkan 12 jam dari waktu sekarang
        $availableLogin = Carbon::now()->addHours(12);

        // Update kolom available_login di database untuk user yang sedang login
        $user->update(['available_login' => $availableLogin]);

        // Hapus semua token yang terkait dengan pengguna
        $user->tokens()->delete();

        // Buat token baru untuk pengguna
        $token = $user->createToken('authToken')->plainTextToken;

        // Kembalikan token dalam respons JSON
        return response()->json(['token' => $token], 200);


        // echo $user;
    }

    public function refresh(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
