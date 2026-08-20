<?php

namespace App\Exports\Adopsi;

use App\Models\CemaraAdopsi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PesananSheet implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Data Pesanan';
    }

    public function query()
    {
        return CemaraAdopsi::with(['paket', 'user'])->orderBy('created_at', 'desc');
    }

    public function headings(): array
    {
        return [
            "Kode Transaksi", 
            "Nama Pemesan", 
            "Nama Sertifikat", 
            "Telepon", 
            "Paket", 
            "Tipe", 
            "Jumlah Bibit", 
            "Total Harga", 
            "Metode Bayar", 
            "Status", 
            "Akun Member", 
            "Dibayar At", 
            "Diverifikasi At", 
            "Catatan Admin"
        ];
    }

    public function map($row): array
    {
        $tipe = $row->paket->is_donasi ? 'Donasi' : 'Reguler';
        $jumlah = ($row->paket->is_donasi && $row->jumlah == 0) ? 'Menunggu konversi' : $row->jumlah;

        return [
            $row->kode_transaksi,
            $row->nama_pemesan,
            $row->nama_sertifikat,
            $row->telepon ?? '-',
            $row->paket->nama ?? '-',
            $tipe,
            $jumlah,
            $row->total_harga,
            $row->metode_bayar,
            $row->status,
            $row->user->email ?? '-',
            $row->dibayar_at ? $row->dibayar_at->format('Y-m-d H:i') : '-',
            $row->diverifikasi_at ? $row->diverifikasi_at->format('Y-m-d H:i') : '-',
            $row->catatan_admin ?? '-',
        ];
    }
}
