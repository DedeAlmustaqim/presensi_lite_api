<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DinasController extends Controller
{
    public function tugas_dinas(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'date' => 'required',
                'ket' => 'required',
                'part_day' => 'required',
                'no_surat' => 'required',
            ],
            [
                'date' => 'required',
                'ket' => 'required',
                'part_day' => 'required',
                'no_surat' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        //Custome Array


        $date = $validatedData['date'];
        $id = $validatedData['id'];
        $ket = $validatedData['ket'];
        $no_surat = $validatedData['no_surat'];
        $part_day = $validatedData['part_day'];

        //jika tgl_in ada
        $cek_tgl_in = DB::table('tbl_absen')
            ->select('tgl_in')
            ->where('tgl_in', $date)
            ->where('id_user', $id)
            ->count();

        $cek_tgl_out = DB::table('tbl_absen')
            ->select('tgl_out')
            ->where('tgl_out', $date)
            ->where('id_user', $id)
            ->count();

        // echo $cek_tgl_in.$cek_tgl_out;

        //CheckIN
        if ($part_day == 1) {
            if (!$cek_tgl_in && !$cek_tgl_out) {
                $data = [
                    'tgl_in' => $date,
                    'id_ket_in' => 2,
                    'id_user' => $id,
                    'created_at' => $date
                ];
                $data2 = [
                    'tgl_in_off' => $date,
                    'no_surat_in' => $no_surat,
                    'ket_in' => $ket,
                    'id_user' => $id,
                    


                ];

                $result = DB::table('tbl_absen')->insert($data);
                $result2 = DB::table('off_day_in')->insert($data2);

                if ($result && $result2) {
                    $respond = [
                        'success' => true,
                        'status' => 1,
                        'judul' => "Berhasil",
                        'msg' => 'Absen Tugas Dinas Check In pada Tanggal ' . $date,
                        'date' => $date,
                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status' => 2,
                        'judul' => "Gagal",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            } else if (!$cek_tgl_in && $cek_tgl_out) {

                $data = [
                    'tgl_in' => $date,
                    'id_ket_in' => 2,
                    'id_user' => $id,
                ];
                $data2 = [
                    'tgl_in_off' => $date,
                    'no_surat_in' => $no_surat,
                    'ket_in' => $ket,
                    'id_user' => $id,


                ];

                $result = DB::table('tbl_absen')->where('id_user', $id)->where('tgl_out', $date)->update($data);
                $result2 = DB::table('off_day_in')->insert($data2);

                if ($result && $result2) {
                    $respond = [
                        'success' => true,
                        'status' => 1,
                        'judul' => "Berhasil",
                        'msg' => 'Absen Tugas Dinas Check In pada Tanggal ' . $date,
                        'date' => $date,
                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status' => 2,
                        'judul' => "Gagal",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            } else if ($cek_tgl_in && !$cek_tgl_out) {
                $respond = [
                    'success' => false,
                    'status' => 0,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah Check In ' . $date,
                    'date' => $date,
                ];
                return response()->json(['data' => $respond]);
            } else if ($cek_tgl_in) {
                $respond = [
                    'success' => false,
                    'status' => 0,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah Check In ' . $date,
                    'date' => $date,
                ];
                return response()->json(['data' => $respond]);
            }
        }
        //CheckOut
        elseif ($part_day == 2) {
            if (!$cek_tgl_in && !$cek_tgl_out) {
                $data = [
                    'tgl_out' => $date,
                    'id_ket_out' => 2,
                    'id_user' => $id,
                    'created_at' => $date
                ];
                $data2 = [
                    'tgl_out_off' => $date,
                    'no_surat_out' => $no_surat,
                    'ket_out' => $ket,
                    'id_user' => $id,


                ];

                $result = DB::table('tbl_absen')->insert($data);
                $result2 = DB::table('off_day_out')->insert($data2);

                if ($result && $result2) {
                    $respond = [
                        'success' => true,
                        'status' => 1,
                        'judul' => "Berhasil ",
                        'msg' => 'Absen Tugas Dinas Check Out pada Tanggal ' . $date,
                        'date' => $date,
                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status' => 2,
                        'judul' => "Gagal",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            } else if ($cek_tgl_in && !$cek_tgl_out) {

                $data = [
                    'tgl_out' => $date,
                    'id_ket_out' => 2,
                    'id_user' => $id,
                    'created_at' => $date
                ];
                $data2 = [
                    'tgl_out_off' => $date,
                    'no_surat_out' => $no_surat,
                    'ket_out' => $ket,
                    'id_user' => $id,


                ];

                $result = DB::table('tbl_absen')->where('id_user', $id)->where('tgl_in', $date)->update($data);
                $result2 = DB::table('off_day_out')->insert($data2);

                if ($result && $result2) {
                    $respond = [
                        'success' => true,
                        'status' => 1,
                        'judul' => "Berhasil ",
                        'msg' => 'Absen Tugas Dinas Check Out pada Tanggal ' . $date,
                        'date' => $date,
                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status' => 2,
                        'judul' => "Gagal",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            } else if (!$cek_tgl_in && $cek_tgl_out) {
                $respond = [
                    'success' => false,
                    'status' => 0,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah Check Out ' . $date,
                    'date' => $date,
                ];
                return response()->json(['data' => $respond]);
            } else if ($cek_tgl_out) {
                $respond = [
                    'success' => false,
                    'status' => 0,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah Check Out ' . $date,
                    'date' => $date,
                ];
                return response()->json(['data' => $respond]);
            }
        }

        //full time
        elseif ($part_day == 3) {
            if (!$cek_tgl_in && !$cek_tgl_out) {
                $data = [
                    'tgl_in' => $date,
                    'id_ket_in' => 2,
                    'tgl_out' => $date,
                    'id_ket_out' => 2,
                    'id_user' => $id,
                    'created_at' => $date
                ];
                $data2 = [
                    'tgl_in_off' => $date,
                    'no_surat_in' => $no_surat,
                    'ket_in' => $ket,
                    'id_user' => $id,


                ];
                $data3 = [
                    'tgl_out_off' => $date,
                    'no_surat_out' => $no_surat,
                    'ket_out' => $ket,
                    'id_user' => $id,


                ];

                $result = DB::table('tbl_absen')->insert($data);
                $result2 = DB::table('off_day_in')->insert($data2);
                $result3 = DB::table('off_day_out')->insert($data3);

                if ($result && $result2 && $result3) {
                    $respond = [
                        'success' => true,
                        'status' => 1,
                        'judul' => "Berhasil ",
                        'msg' => 'Absen Tugas Dinas Check In dan Out pada Tanggal ' . $date,
                        'date' => $date,
                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status' => 2,
                        'judul' => "Gagal",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            } else if ($cek_tgl_in || $cek_tgl_out) {

                $respond = [
                    'success' => false,
                    'status' => 0,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah Check In/Out ' . $date,
                    'date' => $date,
                ];
                return response()->json(['data' => $respond]);
            }
        }
    }

    public function dalam_daerah(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'ket' => 'required',
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
        $ket = $validatedData['ket'];
        $no_surat = $validatedData['no_surat'];

        if ($dateEnd < $dateStart) {
          
            $respond = [
                'success' => false,
                'judul' => "Gagal",
                'msg' => 'Tanggal kembali tidak boleh kurang dari tanggal berangkat.',

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
                        'id_ket_in' => 3,
                        'tgl_out' => $currentDate,
                        'id_ket_out' => 3,
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
                        'msg' => 'Absen  Dinas Dalam Daerah pada Tanggal ' . $dateStart . ' s/d ' . $dateEnd,

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

    public function luar_daerah(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'ket' => 'required',
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
        $ket = $validatedData['ket'];
        $no_surat = $validatedData['no_surat'];

        if ($dateEnd < $dateStart) {
          
            $respond = [
                'success' => false,
                'judul' => "Gagal",
                'msg' => 'Tanggal kembali tidak boleh kurang dari tanggal berangkat.',

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
                        'id_ket_in' => 4,
                        'tgl_out' => $currentDate,
                        'id_ket_out' => 4,
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
                        'msg' => 'Absen  Dinas Luar Daerah pada Tanggal ' . $dateStart . ' s/d ' . $dateEnd,

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
