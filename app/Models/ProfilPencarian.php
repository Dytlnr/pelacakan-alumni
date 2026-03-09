<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPencarian extends Model
{
    protected $table = 'profil_pencarian';

    protected $fillable = [
        'alumni_id',
        'variasi_nama',
        'keyword_afiliasi',
        'keyword_konteks',
    ];

    protected $casts = [
        'variasi_nama' => 'array',
        'keyword_afiliasi' => 'array',
        'keyword_konteks' => 'array',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}
