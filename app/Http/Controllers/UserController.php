<?php

namespace App\Http\Controllers;

use App\Models\AbsenModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index($id)
    {

        $user = User::find($id);
        $data = $user->unitJoin()->select('users.*', 'tbl_unit.nm_unit', 'tbl_unit.lat', 'tbl_unit.long', 'tbl_unit.radius')->get();
        return response()->json($data);
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

                return response()->json($respond);
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

                    return response()->json($respond, 201);
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

            return response()->json($respond, 422);
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
                return response()->json($respond);
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
                    return response()->json($respond);
                    
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
                    return response()->json($respond);
                } else {
                    $respond = [
                        'success' => false,
                        'status'    => 2,
                        'judul'     => "Gagal Absensi",
                        'msg'       => 'Terjadi Kesalahan',

                    ];
                    return response()->json($respond);
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
            return $this->respond($respond);
        }
    }
}
