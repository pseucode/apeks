<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelapor extends Model
{
    use HasFactory;
    protected $fillable = ['nip', 'nama', 'jabatan', 'jns_kelamin', 'no_telp'];

    public function pengaduan(){
        return $this->hasMany(Pengaduan::class);
    }
}