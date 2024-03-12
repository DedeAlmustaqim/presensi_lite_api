<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CutiController extends Controller
{
    

    public function cuti_add(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'ket' => 'required',
                'jns' => 'required',
                'no_surat' => 'required',
            ],

        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        //Custome Array


        $dateStart = $validatedData['date_start'];
        $dateEnd = $validatedData['date_end'];
        $id = $validatedData['id'];
        $jns = $validatedData['jns'];
        $ket = $validatedData['ket'];
        $no_surat = $validatedData['no_surat'];

        if ($dateEnd < $dateStart) {
          
            $respond = [
                'success' => false,
                'judul' => "Gagal",
                'msg' => 'Tanggal sampai tidak boleh kurang dari tanggal dari.',

            ];

            return response()->json(['data' => $respond]);
        } else {
            $cek_tgl_in = DB::table('tbl_absen')
                ->select('tgl_in')
                ->whereBetween('tgl_in', [$dateStart, $dateEnd])
                ->where('id_user', $id)
                ->count();

            $cek_tgl_out = DB::table('tbl_absen')
                ->select('tgl_out')
                ->whereBetween('tgl_out', [$dateStart, $dateEnd])
                ->where('id_user', $id)
                ->count();

            // echo $cek_tgl_in.$cek_tgl_out;

            //CheckIN
            if (!$cek_tgl_in && !$cek_tgl_out) {
                $data = [];
                $data2 = [];
                $data3 = [];
                $currentDate = $dateStart;
                while ($currentDate <= $dateEnd) {
                    $data[] = [
                        'tgl_in' => $currentDate,
                        'id_ket_in' => $jns,
                        'tgl_out' => $currentDate,
                        'id_ket_out' => $jns,
                        'id_user' => $id,
                        'created_at' => $currentDate
                    ];

                    $data2[] = [
                        'tgl_in_off' => $currentDate,
                        'no_surat_in' => $no_surat,
                        'ket_in' => $ket,
                        'id_user' => $id,
                    ];

                    $data3[] = [
                        'tgl_out_off' => $currentDate,
                        'no_surat_out' => $no_surat,
                        'ket_out' => $ket,
                        'id_user' => $id,
                    ];

                    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
                }

                // Sisipkan data ke dalam database


                $result = DB::table('tbl_absen')->insert($data);
                $result2 = DB::table('off_day_in')->insert($data2);
                $result3 = DB::table('off_day_out')->insert($data3);

                if ($result && $result2 && $result3) {
                    $respond = [
                        'success' => true,
                        'judul' => "Berhasil ",
                        'msg' => 'Cuti pada Tanggal ' . $dateStart . ' s/d ' . $dateEnd,

                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'judul' => "Gagal",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            } else if ($cek_tgl_in || $cek_tgl_out) {

                $respond = [
                    'success' => false,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah ada Check In/Out antara tanggal ' . $dateStart . ' s/d ' . $dateEnd,

                ];
                return response()->json(['data' => $respond]);
            }
        }

        //jika tgl_in ada

    }

   
}
