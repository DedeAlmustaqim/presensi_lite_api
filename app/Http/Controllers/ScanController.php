<?php

namespace App\Http\Controllers;

use App\Models\ScanModel;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    //
    public function index($id)
    {

        $data = ScanModel::join('tbl_unit', 'tbl_unit.id', '=', 'tbl_qr_scan.id_unit')
        ->select('tbl_qr_scan.*', 'tbl_unit.nm_unit', 'tbl_unit.lat', 'tbl_unit.long', 'tbl_unit.radius')
        ->where('tbl_qr_scan.id_unit', $id)
        ->first(); 
        return response()->json($data);
    }
}
