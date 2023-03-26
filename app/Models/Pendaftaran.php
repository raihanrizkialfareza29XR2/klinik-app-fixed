<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Pendaftaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id');
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id');
    }
}
