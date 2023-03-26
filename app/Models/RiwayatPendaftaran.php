<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pendaftaran';

    protected $guarded = ['id'];
}
