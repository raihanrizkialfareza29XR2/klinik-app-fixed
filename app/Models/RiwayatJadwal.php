<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJadwal extends Model
{
    use HasFactory;

    protected $table = 'riwayat_jadwal';

    protected $guarded = ['id'];
}
