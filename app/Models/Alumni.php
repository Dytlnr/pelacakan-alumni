<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumni';

    protected $fillable = [
        'nama',
        'prodi',
        'tahun_lulus',
        'kota',
        'bidang',
        'status',
    ];

    public function profilPencarian()
    {
        return $this->hasOne(ProfilPencarian::class, 'alumni_id');
    }

    public function hasilPelacakan()
    {
        return $this->hasMany(HasilPelacakan::class, 'alumni_id');
    }
}
