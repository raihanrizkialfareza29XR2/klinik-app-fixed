<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatDokter extends Model
{
    use HasFactory;

    protected $table = 'riwayat_dokter';

    protected $guarded = ['id'];
}
