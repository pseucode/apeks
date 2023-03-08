<?php

namespace App\Imports;

use App\Models\Pelapor;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelaporImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $pelapor = new Pelapor;
        $pelapor->nip = $row['nip'];
        $pelapor->nama = $row['nama'];
        $pelapor->jabatan = $row['jabatan'];
        $pelapor->jns_kelamin = $row['jns_kelamin'];
        $pelapor->no_telp = $row['no_telp'];
        $pelapor->save();
        Alert::success('Sukses', 'Data berhasil diimport');
    }
}
