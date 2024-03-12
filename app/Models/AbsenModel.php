<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenModel extends Model
{
    protected $table = 'tbl_absen';
    protected $guraded = [];
    use HasFactory;

    public function getIjin($month, $year, $id)
    {
        return $this->leftJoin('tbl_ket as ket_in', 'tbl_absen.id_ket_in', '=', 'ket_in.id')
            ->leftJoin('tbl_ket as ket_out', function ($join) {
                $join->on('tbl_absen.id_ket_out', '=', 'ket_out.id')
                    ->whereNotNull('tbl_absen.id_ket_out'); // LEFT JOIN hanya jika id_ket_out tidak null
            })->whereMonth('tbl_absen.created_at', $month)
            ->whereYear('tbl_absen.created_at', $year)
            ->where('tbl_absen.id_user', $id)
            ->where('tbl_absen.stts_ijin', 1)
            ->get();
    }

    public function getRekapBulanan($month, $year, $id)
    {
        return $this
            ->select(
                'tbl_absen.id_absen',
                'tbl_absen.tgl_in',
                'tbl_absen.jam_in',
                'tbl_absen.jam_out',
                'tbl_absen.tgl_out',
                'ket_in.ket as keterangan_in',
                'ket_out.ket as keterangan_out',
                'tbl_absen.id_ket_in',
                'tbl_absen.id_ket_out',
                'off_day_in.no_surat_in',
                'off_day_in.ket_in',
                'off_day_out.no_surat_out',
                'off_day_out.ket_out'
            )
            ->leftJoin('off_day_in', function ($join) {
                $join->on('tbl_absen.id_user', '=', 'off_day_in.id_user')
                    ->on('tbl_absen.tgl_in', '=', 'off_day_in.tgl_in_off');
            })
            ->leftJoin('tbl_ket as ket_in', 'tbl_absen.id_ket_in', '=', 'ket_in.id')
            ->leftJoin('tbl_ket as ket_out', 'tbl_absen.id_ket_out', '=', 'ket_out.id')
            ->leftJoin('off_day_out', function ($join) {
                $join->on('tbl_absen.tgl_out', '=', 'off_day_out.tgl_out_off')
                    ->on('tbl_absen.id_user', '=', 'off_day_out.id_user');
            })
            ->where('tbl_absen.id_user', $id)
            ->whereMonth('tbl_absen.created_at', $month)
            ->whereYear('tbl_absen.created_at', $year)
            ->orderBy('tbl_absen.created_at', 'ASC')
            ->get();
    }

    public function getToday($today, $id)
    {
        return $this->select(
                'tbl_absen.id_absen',
                'tbl_absen.tgl_in',
                'tbl_absen.jam_in',
                'tbl_absen.jam_out',
                'tbl_absen.tgl_out',
                'ket_in.ket as keterangan_in',
                'ket_out.ket as keterangan_out',
                'tbl_absen.id_ket_in',
                'tbl_absen.id_ket_out',
              
            )
          
            ->leftJoin('tbl_ket as ket_in', 'tbl_absen.id_ket_in', '=', 'ket_in.id')
            ->leftJoin('tbl_ket as ket_out', 'tbl_absen.id_ket_out', '=', 'ket_out.id')
          
            ->where('tbl_absen.id_user', $id)
            ->whereDate('created_at', '=', $today->toDateString())
            ->orderBy('tbl_absen.created_at', 'ASC')
            ->get();
    }

    public function getDay($today, $id)
    {
        return $this
            ->select(
                'tbl_absen.id_absen',
                'tbl_absen.tgl_in',
                'tbl_absen.jam_in',
                'tbl_absen.jam_out',
                'tbl_absen.tgl_out',
                'ket_in.ket as keterangan_in',
                'ket_out.ket as keterangan_out',
                'tbl_absen.id_ket_in',
                'tbl_absen.id_ket_out',
                'off_day_in.no_surat_in',
                'off_day_in.ket_in',
                'off_day_out.no_surat_out',
                'off_day_out.ket_out'
            )
            ->leftJoin('off_day_in', function ($join) {
                $join->on('tbl_absen.id_user', '=', 'off_day_in.id_user')
                    ->on('tbl_absen.tgl_in', '=', 'off_day_in.tgl_in_off');
            })
            ->leftJoin('tbl_ket as ket_in', 'tbl_absen.id_ket_in', '=', 'ket_in.id')
            ->leftJoin('tbl_ket as ket_out', 'tbl_absen.id_ket_out', '=', 'ket_out.id')
            ->leftJoin('off_day_out', function ($join) {
                $join->on('tbl_absen.tgl_out', '=', 'off_day_out.tgl_out_off')
                    ->on('tbl_absen.id_user', '=', 'off_day_out.id_user');
            })
            ->where('tbl_absen.id_user', $id)
            ->whereDate('created_at', '=', $today)
            ->orderBy('tbl_absen.created_at', 'ASC')
            ->get();
    }
 
}
