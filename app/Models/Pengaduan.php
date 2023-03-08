<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'barang', 'lokasi', 'tgl_aduan', 'isi_aduan', 'permasalahan', 'penyelesaian', 'tgl_followups', 'pengerjaan', 'status', 'catatan', 'signature', 'pelapor_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    public function pelapor(){
        return $this->belongsTo(Pelapor::class);
    }

    public function kinerja(){
        return $this->hasOne(Kinerja::class);
    }

    public function ttd()
    {
        return "/signatures/" .  $this->signature;
    }
}
