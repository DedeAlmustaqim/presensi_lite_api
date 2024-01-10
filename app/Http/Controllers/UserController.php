<?php

namespace App\Http\Controllers;

use App\Models\AbsenModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\DateHelper;

class UserController extends Controller
{
    
    //Ambil Data User join dengan Unit
    public function userData($id)
    {
        $user = User::find($id);
        $userData = $user->unitJoin()->select('users.*', 'tbl_unit.nm_unit', 'tbl_unit.lat', 'tbl_unit.long', 'tbl_unit.radius')->first();
        return $userData;
    }

    public function index($id)
    {

        $data = $this->userData($id);
        return response()->json(['data' => $data]);
    }
 


    
    //Verifikasi Lokasi
    public function verifyLocation(Request $request)
    {
        $id = $request->input('id');
        $data = $this->userData($id);

        $userLatitude = $data['lat'];
        $userLongitude = $data['long'];
        $userRadius = $data['radius'];
        $targetLatitude = $request->input('latitude');
        $targetLongitude = $request->input('longitude');
        $distance = $this->haversineDistance($userLatitude, $userLongitude, $targetLatitude, $targetLongitude);

        if ($distance <= 0.1) { // Jarak dalam satuan kilometer (100 meter = 0.1 km)
            return response()->json(['data' => [
                'success' => true,
                'koordinat' => "Latitude: " . $userLatitude . " Longitude: " . $userLongitude . " Radius : " . $userRadius . " m",
                'message' => 'Anda berada di dalam radius titik absen'
            ],], 200);
        } else {
            return response()->json(['data' => [
                'success' => false,
                'koordinat' => "Latitude: " . $userLatitude . " Longitude: " . $userLongitude . " Radius : " . $userRadius . " m",
                'message' => 'Anda berada di luar radius titik absen'
            ],], 200);
        }
    }

    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Earth radius in kilometers
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2)
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2))
            * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        return $distance;
    }

    public function qr_in(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'qr_in' => 'required',
                'id' => 'required',
            ],
            [
                'qr_in.required' => 'Kolom  wajib diisi.',
                'id.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        //Custome Array
        if (array_key_exists('qr_in', $validatedData)) {
            $validatedData['qr_in_kode'] = substr($validatedData['qr_in'], -10);
            $validatedData['tgl'] = substr($validatedData['qr_in'], 0, -10);
        }

        $qr_in = $validatedData['qr_in_kode'];
        $tgl = $validatedData['tgl'];
        $id_user = $validatedData['id'];

        $builder = DB::table('tbl_qr_scan')
            ->select('qr_in')
            ->where('qr_in', $qr_in)
            ->where('users.id', $id_user)
            ->join('users', 'users.id_unit', '=', 'tbl_qr_scan.id_unit')
            ->count();

        if ($builder) {
            $cek_tgl = DB::table('tbl_absen')
                ->select('tgl_in')
                ->where('tgl_in', $tgl)
                ->where('id_user', $id_user)
                ->count();

            if ($cek_tgl) {
                $respond = [
                    'success' => false,
                    'status' => 0,
                    'judul' => "Gagal",
                    'msg' => 'Anda sudah absen masuk pada ' . $tgl,
                    'date' => $tgl,
                ];

                return response()->json(['data' => $respond]);
            } else {
                $data = [
                    'tgl_in' => $tgl,
                    'jam_in' => now()->format('H:i:s'),
                    'id_ket_in' => 1,
                    'id_ket_out' => 0,
                    'id_user' => $id_user,
                ];

                $result = DB::table('tbl_absen')->insert($data);

                if ($result) {
                    $respond = [
                        'success' => true,
                        'status' => 1,
                        'judul' => "Berhasil",
                        'msg' => 'Tanggal Absensi ' . $tgl,
                        'date' => $tgl,
                    ];

                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status' => 2,
                        'judul' => "Gagal Absensi",
                        'msg' => 'Terjadi Kesalahan',
                    ];

                    return response()->json($respond, 500);
                }
            }
        } else {
            $respond = [
                'success' => false,
                'status' => 3,
                'judul' => "Gagal Absensi",
                'msg' => 'Gagal verifikasi kode QR, silahkan coba lagi',
            ];

            return response()->json(['data' => $respond]);
        }
    }
    public function qr_out(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'qr_out' => 'required',
                'id' => 'required',
            ],
            [
                'qr_out.required' => 'Kolom  wajib diisi.',
                'id.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        //Custome Array
        if (array_key_exists('qr_out', $validatedData)) {
            $validatedData['qr_out_kode'] = substr($validatedData['qr_out'], -10);
            $validatedData['tgl'] = substr($validatedData['qr_out'], 0, -10);
        }

        $qr_out = $validatedData['qr_out_kode'];
        $tgl = $validatedData['tgl'];
        $id_user = $validatedData['id'];

        // echo $qr_out.$tgl.$id_user;
        $builder = DB::table('tbl_qr_scan')
            ->select('qr_out')
            ->where('qr_out', $qr_out)
            ->where('users.id', $id_user)
            ->join('users', 'users.id_unit', '=', 'tbl_qr_scan.id_unit')
            ->count();

        // echo $builder;
        // $cek_tgl = DB::table('tbl_absen')->select('tgl_in')->where('tgl_in', $tgl)->where('id_user', $id_user)->count();
        // echo $cek_tgl;

        if ($builder) {
            $cek_tgl = DB::table('tbl_absen')->select('tgl_in')->where('tgl_in', $tgl)->where('id_user', $id_user)->count();
            if (!$cek_tgl) {
                $respond = [
                    'success' => false,
                    'status'    => 0,
                    'judul'     => "Gagal",
                    'msg'       => 'Anda belum absen masuk pada ' . $tgl . ', lakukan absen masuk atau ajukan Ijin',
                    'date'      => $tgl,
                    'qr_out'    => $qr_out,
                ];
                return response()->json(['data' => $respond]);
            } else {
                $cek_tgl_out = DB::table('tbl_absen')->select('tgl_out')->where('tgl_out', $tgl)->where('id_user', $id_user)->count();

                if ($cek_tgl_out) {
                    $respond = [
                        'success' => false,
                        'status'    => 0,
                        'judul'     => "Gagal",
                        'msg'       => 'Anda sudah Absen Keluar pada ' . $tgl,
                        'date'      => $tgl,
                        'qr_out'    => $qr_out,
                    ];
                    return response()->json(['data' => $respond]);
                } else {
                    $data = [
                        'tgl_out'           => $tgl,
                        'jam_out'           => date('H:i:s'),
                        'id_ket_out'        => 1,


                    ];
                    $result = DB::table('tbl_absen')
                        ->where('tgl_in', $tgl)
                        ->update($data);
                }

                if ($result) {
                    $respond = [
                        'success' => true,
                        'status'    => 1,
                        'judul'     => "Berhasil",
                        'msg'       => 'Tanggal Absensi ' . $tgl,
                        'date'      => $tgl
                    ];
                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status'    => 2,
                        'judul'     => "Gagal Absensi",
                        'msg'       => 'Terjadi Kesalahan',

                    ];
                    return response()->json(['data' => $respond]);
                }
            }
        } else {
            $respond = [
                'success' => false,
                'status' => 3,
                'judul' => "Gagal Absensi",
                'msg'      => 'Gagal verifikasi Kode QR, silahkan coba lagi',
                'qr_out'    => $qr_out,

            ];
            return response()->json(['data' => $respond]);
        }
    }

    public function ijin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'tgl' => 'required',
                'id_ket' => 'required',
                'ket' => 'required',
                'kondisi' => 'required',
            ],

        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        //Custome Array
        //if (array_key_exists('input_name', $validatedData)) {
        // $validatedData['input_name'] =  .... ;
        //}
        try {

            // Kondisi 1
            if ($validatedData['kondisi'] == 1) {
                $cek_tgl = DB::table('tbl_absen')
                    ->select('tgl_in')
                    ->where('tgl_in', $validatedData['tgl'])
                    ->where('id_user', $validatedData['id'])
                    ->count();

                if ($cek_tgl) {
                    $respond = [
                        'success' => false,
                        'judul'   => "Gagal",
                        'msg'     => 'Anda sudah Absen Masuk pada ' . $validatedData['tgl'],
                    ];
                    return response()->json(['data' => $respond]);
                } else {
                    $data = [
                        'tgl_in'         => $validatedData['tgl'],
                        'jam_in'         => now()->format('H:i:s'),
                        'id_ket_in'      => $validatedData['id_ket'],
                        'id_ket_out'     => 0,
                        'id_user'        => $validatedData['id'],
                        'ket_absen_in'   => $validatedData['ket'],
                        'stts_ijin'      => 1,
                    ];

                    $result = AbsenModel::insert($data);

                    if ($result) {
                        $respond = [
                            'success' => true,
                            'judul'   => "Berhasil",
                            'msg'     => 'Berhasil ijin pada jam masuk, tanggal ijin ' . $validatedData['tgl'],
                        ];
                        return response()->json(['data' => $respond]);
                    } else {
                        $respond = [
                            'success' => false,
                            'judul'   => "Gagal",
                            'msg'     => 'Terjadi Kesalahan',
                        ];
                        return response()->json(['data' => $respond]);
                    }
                }
            }

            // Kondisi 2
            if ($validatedData['kondisi'] == 2) {
                $cek_tgl_in = DB::table('tbl_absen')
                    ->select('tgl_in')
                    ->where('tgl_in', $validatedData['tgl'])
                    ->where('id_user', $validatedData['id'])
                    ->count();

                if ($cek_tgl_in) {
                    $cek_tgl = DB::table('tbl_absen')
                        ->select('tgl_out')
                        ->where('tgl_out', $validatedData['tgl'])
                        ->where('id_user', $validatedData['id'])
                        ->count();

                    if ($cek_tgl) {
                        $respond = [
                            'success' => false,
                            'judul'   => "Gagal",
                            'msg'     => 'Anda sudah Absen Pulang pada ' . $validatedData['tgl'],
                        ];
                        return response()->json(['data' => $respond]);
                    } else {
                        $data = [
                            'tgl_out'        => $validatedData['tgl'],
                            'jam_out'        => now()->format('H:i:s'),
                            'id_ket_out'     => $validatedData['id_ket'],
                            'id_user'        => $validatedData['id'],
                            'ket_absen_out'  => $validatedData['ket'],
                            'stts_ijin'      => 1,
                        ];

                        $result = DB::table('tbl_absen')->where('tgl_in', $validatedData['tgl'])->update($data);

                        if ($result) {
                            $respond = [
                                'success' => true,
                                'judul'   => "Berhasil",
                                'msg'     => 'Berhasil ijin pada jam pulang, tanggal ijin ' . $validatedData['tgl'],
                            ];
                            return response()->json(['data' => $respond]);
                        } else {
                            $respond = [
                                'success' => false,
                                'judul'   => "Gagal",
                                'msg'     => 'Terjadi Kesalahan',
                            ];
                            return response()->json(['data' => $respond]);
                        }
                    }
                } else {
                    $respond = [
                        'success' => false,
                        'judul'   => "Gagal",
                        'msg'     => 'Anda belum absen masuk, lakukan absen masuk terlebih dulu atau ajukan ijin',
                    ];
                    return response()->json(['data' => $respond]);
                }
            }

            // Kondisi 3
            if ($validatedData['kondisi'] == 3) {
                $cek_tgl_in = DB::table('tbl_absen')
                    ->select('tgl_in')
                    ->where('tgl_in', $validatedData['tgl'])
                    ->where('id_user', $validatedData['id'])
                    ->count();

                if ($cek_tgl_in) {
                    $respond = [
                        'success' => false,
                        'judul'   => "Gagal",
                        'msg'     => 'Anda sudah absen masuk pada ' . $validatedData['tgl'],
                    ];
                    return response()->json(['data' => $respond]);
                } else {
                    $cek_tgl_out = DB::table('tbl_absen')
                        ->select('tgl_out')
                        ->where('tgl_out', $validatedData['tgl'])
                        ->where('id_user', $validatedData['id'])
                        ->count();

                    if ($cek_tgl_out) {
                        $respond = [
                            'success' => false,
                            'judul'   => "Gagal",
                            'msg'     => 'Anda sudah absen pulang pada ' . $validatedData['tgl'],
                        ];
                        return response()->json(['data' => $respond]);
                    } else {
                        $data = [
                            'tgl_in'         => $validatedData['tgl'],
                            'tgl_out'        => $validatedData['tgl'],
                            'jam_in'         => now()->format('H:i:s'),
                            'jam_out'        => now()->format('H:i:s'),
                            'id_ket_in'      => $validatedData['id_ket'],
                            'id_ket_out'     => $validatedData['id_ket'],
                            'id_user'        => $validatedData['id'],
                            'ket_absen_in'   => $validatedData['ket'],
                            'ket_absen_out'  => $validatedData['ket'],
                            'stts_ijin'      => 1,
                        ];

                        $result = AbsenModel::insert($data);

                        if ($result) {
                            $respond = [
                                'success' => true,
                                'judul'   => "Berhasil",
                                'msg'     => 'Berhasil ijin pada sehari penuh pada ' . $validatedData['tgl'],
                            ];
                            return response()->json(['data' => $respond]);
                        } else {
                            $respond = [
                                'success' => false,
                                'judul'   => "Gagal",
                                'msg'     => 'Terjadi Kesalahan',
                            ];
                            return response()->json(['data' => $respond]);
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    public function get_ijin_bulanan(Request $request)
    {
        // $id_user = request()->input('id_user');
        // $tahun = request()->input('tahun');
        $bulan = $request->input('bulan');

        $bulan = bulan_to_angka($bulan);

        if ($bulan === null) {
            return response()->json(['error' => 'Bulan tidak valid'], 400);
        }

        // $model = new UserModel();
        // $data['data'] = $model->getIjin($id_user, $tahun, $bulan);

        return response()->json($bulan);
    }
}
