<?php

namespace App\Http\Controllers;

use App\Models\ConfigModel;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $data = ConfigModel::first();

        if ($data) {
            // Buat array baru hanya dengan properti yang diinginkan
            $result = [
                'version'=> $data->versi_apk
            ];

            // Kembalikan data yang digabungkan sebagai JSON
            return response()->json($result);
        } else {
            // Tangani kasus di mana salah satu dari $data1 atau $data2 adalah null
            return response()->json(['error' => 'Data tidak ditemukan.']);
        }
    }
}
