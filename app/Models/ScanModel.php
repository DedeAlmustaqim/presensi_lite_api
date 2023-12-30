<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_qr_scan';
    protected $guarded = [];

    public function unitScanJoin()
    {
        return $this->join('tbl_unit', 'tbl_qr_scan.id_unit', '=', 'tbl_unit.id');
    }
}
