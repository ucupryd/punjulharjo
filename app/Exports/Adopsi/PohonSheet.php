<?php

namespace App\Exports\Adopsi;

use App\Models\CemaraPohon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PohonSheet implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Data Pohon Tertanam';
    }

    public function query()
    {
        return CemaraPohon::with(['adopsi.paket', 'user'])->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            "Kode Pohon", 
            "Nama Sertifikat", 
            "Jenis", 
            "Tanggal Tanam", 
            "Lokasi (Lat, Lng)", 
            "Keterangan Lokasi", 
            "Status", 
            "Pemilik/Member", 
            "Kode Transaksi Asal", 
            "Asal Paket"
        ];
    }

    public function map($row): array
    {
        $pemilik = $row->user->email ?? ($row->adopsi->nama_pemesan ?? '-');
        $lokasi = ($row->lat && $row->lng) ? "{$row->lat}, {$row->lng}" : '-';

        return [
            $row->kode_pohon,
            $row->nama_sertifikat,
            $row->jenis,
            $row->tanggal_tanam ? $row->tanggal_tanam->format('Y-m-d') : '-',
            $lokasi,
            $row->lokasi_teks ?? '-',
            $row->status,
            $pemilik,
            $row->adopsi->kode_transaksi ?? '-',
            $row->adopsi->paket->nama ?? '-',
        ];
    }
}
