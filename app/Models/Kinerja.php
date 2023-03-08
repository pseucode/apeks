<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    use HasFactory;

    protected $fillable = ['poin_cek', 'poin_selesai', 'over_cek', 'over_selesai', 'user_id', 'pengaduan_id', 'followup_id'];

    public function pengaduan(){
        return $this->belongsTo(Pengaduan::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
