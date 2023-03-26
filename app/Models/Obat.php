<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $guarded = ['id'];


    /**
     * Get the user that owns the Obat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jenis()
    {
        return $this->belongsTo(JenisObat::class, 'id_jenis_obat', 'id');
    }
    public function kategori()
    {
        return $this->hasMany(KategoriObat::class, 'id', 'id_kategori');
    }
}

