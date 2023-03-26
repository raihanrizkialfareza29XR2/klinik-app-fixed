<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    use HasFactory;

    protected $table = 'detail_resep';
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the DetailResep
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function obat()
    {
        return $this->hasMany(Obat::class, 'id', 'id_obat');
    }
}
