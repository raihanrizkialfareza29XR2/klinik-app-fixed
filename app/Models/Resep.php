<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'resep';

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Resep
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function obat()
    {
        return $this->hasMany(Obat::class, 'id_obat', 'id');
    }
}
