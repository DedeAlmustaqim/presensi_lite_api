<?php

namespace App\Http\Controllers;

use App\Models\ConfigModel;
use App\Models\ScanModel;
use App\Models\UnitModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanController extends Controller
{
    //
    public function index($id)
    {
        $data1 = UnitModel::select('tbl_unit.*')->where('tbl_unit.id', $id)->first();
        $data2 = ConfigModel::first();

        // Periksa apakah $data1 dan $data2 tidak null
        if ($data1 && $data2) {
            // Buat array baru hanya dengan properti yang diinginkan
            $result = [
                'id' => $data1->id,
                'id_unit' => $data1->id_unit,
                'qr_in' => $data1->qr_in,
                'qr_out' => $data1->qr_out,
                'nm_pemda' => $data2->nm_pemda,  // Mengambil properti dari $data2
                'qr_time_in_start' => $data2->qr_time_in_start,
                'qr_time_in_end' => $data2->qr_time_in_end,
                'qr_time_out_start' => $data2->qr_time_out_start,
                'qr_time_out_end' => $data2->qr_time_out_end,
                'radius' => $data2->radius,
            ];

            // Kembalikan data yang digabungkan sebagai JSON
            return response()->json($result);
        } else {
            // Tangani kasus di mana salah satu dari $data1 atau $data2 adalah null
            return response()->json(['error' => 'Data tidak ditemukan.']);
        }
    }
}
