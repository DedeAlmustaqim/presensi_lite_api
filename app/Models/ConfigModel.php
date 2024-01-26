<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigModel extends Model
{
    protected $table = 'tbl_config';
    protected $guraded = [];
    use HasFactory;
}
