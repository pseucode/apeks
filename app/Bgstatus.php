<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bgstatus extends Model
{ 

  const STATUS_SELECT = [
    'Selesai'  => 'Selesai',
    'Progres'   => 'Progres',
    'Baru' => 'Baru',
    'Dalam Antrian' => 'Dalam Antrian',
    'Menunggu Konfirmasi Sarpras' => 'Menunggu Konfirmasi Sarpras'
  ];

  const STATUS_COLOR = [
    'Selesai'  => '#57f781', //hijau
    'Progres'   => '#F7C04A', //kuning
    'Baru' => '#60c3fc', //biru
    'Dalam Antrian' => '#d1d1d1', //abu-abu
    'Menunggu Konfirmasi Sarpras'  => '#fc9144' //orange
  ];
}