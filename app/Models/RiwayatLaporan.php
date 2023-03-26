<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatLaporan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_laporan';

    protected $guarded = ['id'];
}
