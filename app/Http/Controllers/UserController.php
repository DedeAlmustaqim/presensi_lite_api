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
use App\Models\ConfigModel;
use App\Models\InfoModel;
use App\Models\NewsModel;
use Carbon\Carbon;

class UserController extends Controller
{

    //Ambil Data User join dengan Unit
    public function userData($id)
    {
        $userData = User::join('tbl_unit', 'tbl_unit.id', '=', 'users.id_unit')
            ->select('users.*', 'tbl_unit.nm_unit', 'tbl_unit.lat', 'tbl_unit.long', 'tbl_unit.radius')
            ->where('users.id', $id)
            ->first();
        return $userData;
    }

    public function index($id)
    {

        $data = $this->userData($id);
        return response()->json(['data' => $data]);
    }

    public function get_by_unit($id)
    {
        $data = User::join('tbl_unit', 'tbl_unit.id', '=', 'users.id_unit')
            ->select('users.*', 'tbl_unit.nm_unit', 'tbl_unit.lat', 'tbl_unit.long', 'tbl_unit.radius')
            ->where('users.id_unit', $id)
            ->get();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'nik' => 'required|unique:users,nik',  
                'nip' => 'required|unique:users,nip',
                'id_unit' => 'required',
                'jabatan' => 'required',


            ],
            [
                'name.required' => 'Kolom  wajib diisi.',
                'email.required' => 'Kolom  wajib diisi.',
                'nik.required' => 'Kolom  wajib diisi.',
                'nip.required' => 'Kolom  wajib diisi.',
                'id_unit.required' => 'Kolom  wajib diisi.',
                'jabatan.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }


        $validatedData = $validator->validated();

        $validatedData['password'] = password_hash("baritotimurkab", PASSWORD_BCRYPT);


        try {
            UserModel::create($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'nik' => 'required',  
                'nip' => 'required',
                'id_unit' => 'required',
                'jabatan' => 'required',
            ],
            [
                'name.required' => 'Kolom  wajib diisi.',
                'email.required' => 'Kolom  wajib diisi.',
                'nik.required' => 'Kolom  wajib diisi.',
                'nip.required' => 'Kolom  wajib diisi.',
                'id_unit.required' => 'Kolom  wajib diisi.',
                'jabatan.required' => 'Kolom  wajib diisi.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();

        $findId = UserModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = UserModel::findOrFail($id);
            $data->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e], 500);
        }
    }

    public function destroy($id)
    {
        $findId = UserModel::find($id);

        if (!$findId) {
            return response()->json(['success' => false, 'message' => 'Not Found'], 404);
        }

        try {
            $data = UserModel::findOrFail($id);
            $data->delete();
            return response()->json(['success' => true, 'message' => 'Success'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed'], 500);
        }
    }

    //Verifikasi Lokasi
    public function verifyLocation(Request $request)
    {
        $id = $request->input('id');
        $data = $this->userData($id);
        $data2 = ConfigModel::first();
        $userLatitude = $data['lat'];
        $userLongitude = $data['long'];
        $userRadius = $data2->radius;
        $targetLatitude = $request->input('latitude');
        $targetLongitude = $request->input('longitude');
        $distance = $this->haversineDistance($userLatitude, $userLongitude, $targetLatitude, $targetLongitude);



        $radius =  $data2->radius / 100;
        if ($distance <= $radius) { // Jarak dalam satuan kilometer (100 meter = 0.1 km)
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

        $builder = DB::table('tbl_unit')
            ->select('qr_in')
            ->where('qr_in', $qr_in)
            ->where('users.id', $id_user)
            ->join('users', 'users.id_unit', '=', 'tbl_unit.id')
            ->count();

        if ($builder) {

            $cek_tgl = DB::table('tbl_absen')
                ->select('tgl_in')
                ->where('tgl_in', $tgl)
                ->where('id_user', $id_user)
                ->count();
            $cek_tgl_out = DB::table('tbl_absen')->select('tgl_out')->where('tgl_out', $tgl)->where('id_user', $id_user)->count();
            if (!$cek_tgl_out) {
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
                            'judul' => "Berhasil Check In",
                            'msg' => 'Tanggal ' . $tgl,
                            'date' => $tgl,
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
                }
            } else {
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

                    $result = DB::table('tbl_absen')->where('tgl_out', $tgl)
                        ->update($data);;

                    if ($result) {
                        $respond = [
                            'success' => true,
                            'status' => 1,
                            'judul' => "Berhasil Check In",
                            'msg' => 'Tanggal ' . $tgl,
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
            }
        } else {
            $respond = [
                'success' => false,
                'status' => 3,
                'judul' => "Gagal",
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
        $builder = DB::table('tbl_unit')
            ->select('qr_out')
            ->where('qr_out', $qr_out)
            ->where('users.id', $id_user)
            ->join('users', 'users.id_unit', '=', 'tbl_unit.id')
            ->count();



        if ($builder) {
            $cek_tgl = DB::table('tbl_absen')->select('tgl_in')->where('tgl_in', $tgl)->where('id_user', $id_user)->count();
            if (!$cek_tgl) {
                $data = [
                    'id_user'           => $id_user,
                    'tgl_out'           => $tgl,
                    'jam_out'           => date('H:i:s'),
                    'id_ket_out'        => 1,
                ];

                $cek_tgl_out = DB::table('tbl_absen')->select('tgl_out')->where('tgl_out', $tgl)->where('id_user', $id_user)->count();
                if ($cek_tgl_out) {

                    $respond = [
                        'success' => false,
                        'status'    => 0,
                        'judul'     => "Gagal",
                        'msg'       => 'Anda sudah Check Out  pada ' . $tgl,
                        'date'      => $tgl,
                        'qr_out'    => $qr_out,
                    ];
                    return response()->json(['data' => $respond]);
                } else {
                    $data = [
                        'id_user'           => $id_user,
                        'tgl_out'           => $tgl,
                        'jam_out'           => date('H:i:s'),
                        'id_ket_out'        => 1,


                    ];
                    $result = DB::table('tbl_absen')

                        ->insert($data);
                }

                if ($result) {
                    $respond = [
                        'success' => true,
                        'status'    => 1,
                        'judul'     => "Berhasil Check Out",
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
            } else {
                $cek_tgl_out = DB::table('tbl_absen')->select('tgl_out')->where('tgl_out', $tgl)->where('id_user', $id_user)->count();

                if ($cek_tgl_out) {

                    $respond = [
                        'success' => false,
                        'status'    => 0,
                        'judul'     => "Gagal",
                        'msg'       => 'Anda sudah Check Out  pada ' . $tgl,
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
                        'judul'     => "Berhasil Check Out",
                        'msg'       => 'Tanggal Absensi ' . $tgl,
                        'date'      => $tgl
                    ];
                    return response()->json(['data' => $respond]);
                } else {
                    $respond = [
                        'success' => false,
                        'status'    => 2,
                        'judul'     => "Gagal",
                        'msg'       => 'Terjadi Kesalahan',

                    ];
                    return response()->json(['data' => $respond]);
                }
            }
        } else {
            $respond = [
                'success' => false,
                'status' => 3,
                'judul' => "Gagal",
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

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'date' => 'required',
            ],
            [
                'id.required' => 'Kolom  wajib diisi.',
                'date.required' => 'Kolom  wajib diisi.',
            ]
        );

        $validatedData = $validator->validated();

        $date = Carbon::parse($validatedData['date']);
        $id = $validatedData['id'];
        $month = $date->month;
        $year = $date->year;

        $absenModel = new AbsenModel();
        $data = $absenModel->getIjin($month, $year, $id);

        return response()->json(['data' => $data]);
    }

    public function get_today(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',

            ],
            [
                'id.required' => 'Kolom  wajib diisi.',

            ]
        );

        $validatedData = $validator->validated();

        $date = now();
        $id = $validatedData['id'];


        $absenModel = new AbsenModel();
        $data = $absenModel->getToday($date);

        return response()->json(['data' => $data]);
    }

    public function get_rekap_bulanan(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'date' => 'required',
            ],
            [
                'id.required' => 'Kolom  wajib diisi.',
                'date.required' => 'Kolom  wajib diisi.',
            ]
        );

        $validatedData = $validator->validated();

        $date = Carbon::parse($validatedData['date']);
        $id = $validatedData['id'];
        $month = $date->month;
        $year = $date->year;

        // echo $year;

        $absenModel = new AbsenModel();
        $data = $absenModel->getRekapBulanan($month, $year, $id);

        return response()->json(['data' => $data]);
    }
}
