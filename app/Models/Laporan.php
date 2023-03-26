<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Laporan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admin()
    {
        return $this->hasMany(User::class, 'id_admin', 'id');
    }
}
