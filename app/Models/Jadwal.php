<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $guarded = ['id_jadwal'];

    /**
     * Get the user that owns the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'id');
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id');
    }
}
