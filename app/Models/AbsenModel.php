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
            ->select('tbl_absen.*')

            ->whereMonth('tbl_absen.created_at', $month)
            ->whereYear('tbl_absen.created_at', $year)
            ->where('tbl_absen.id_user', $id)
            ->get();
    }

    public function getToday($today)
    {
        return $this
            ->select('tbl_absen.*')
            ->whereDate('created_at', '=', $today->toDateString())
            ->get();
    }
}
