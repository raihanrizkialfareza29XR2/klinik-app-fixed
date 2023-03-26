<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPoli extends Model
{
    use HasFactory;

    protected $table = 'riwayat_poli';

    protected $guarded = ['id'];
}
