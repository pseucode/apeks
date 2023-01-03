<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengaduan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'jabatan', 'no_telp', 'barang', 'lokasi', 'tgl_aduan', 'isi_aduan', 'status', 'catatan', 'signature'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kinerja(){
        return $this->belongsTo(Kinerja::class);
    }

    public function followup(){
        return $this->hasOne(Followup::class);
    }

    public function ttd()
    {
        return "/signatures/" .  $this->signature;
    }
}
