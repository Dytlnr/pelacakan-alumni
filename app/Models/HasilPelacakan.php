<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPelacakan extends Model
{
    protected $table = 'hasil_pelacakan';

    protected $fillable = [
        'alumni_id',
        'sumber',
        'nama_kandidat',
        'afiliasi',
        'jabatan',
        'lokasi',
        'topik',
        'skor',
        'status',
        'link_bukti',
        'ringkasan',
    ];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'alumni_id');
    }
}
