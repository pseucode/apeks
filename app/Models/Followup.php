<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;
    protected $fillable = ['permasalahan', 'penyelesaian', 'tgl_followups', 'pengerjaan', 'user_id', 'pengaduan_id'];

    public function pengaduan(){
        return $this->belongsTo(Pengaduan::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
