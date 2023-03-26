<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatResep extends Model
{
    use HasFactory;

    protected $table = 'riwayat_resep';

    protected $guarded = ['id'];
}
