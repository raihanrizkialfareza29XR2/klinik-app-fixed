<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPeriksa extends Model
{
    use HasFactory;

    protected $table = 'riwayat_periksa';

    protected $guarded = ['id'];
}
