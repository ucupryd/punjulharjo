<?php

namespace App\Exports\Adopsi;

use App\Models\CemaraMonitoring;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonitoringSheet implements FromQuery, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Riwayat Perkembangan';
    }

    public function query()
    {
        return CemaraMonitoring::with('pohon')->orderBy('tanggal', 'desc');
    }

    public function headings(): array
    {
        return [
            "Kode Pohon",
            "Tanggal Update",
            "Nama Petugas",
            "Status Hidup",
            "Tinggi (cm)",
            "Perkiraan Tinggi",
            "Jumlah Daun",
            "Kondisi Daun",
            "Cabang Baru",
            "Kerusakan",
            "Tindakan Bibit Mati",
            "Catatan",
            "Link Foto",
        ];
    }

    public function map($row): array
    {
        $tindakanLabel = match ($row->pohon->tindakan_bibit_mati ?? null) {
            'ganti' => 'Lokasi tanam ganti',
            'sama' => 'Lokasi tanam sama',
            default => '-',
        };

        $statusLabel = match ($row->pohon->status ?? null) {
            'hidup' => 'Hidup',
            'mati' => 'Mati',
            'perlu_penyulaman' => 'Perlu Penyulaman',
            'menunggu_tanam' => 'Menunggu Tanam',
            default => '-',
        };

        return [
            $row->pohon->kode_pohon ?? '-',
            $row->tanggal->format('Y-m-d'),
            $row->nama_petugas ?? '-',
            $statusLabel,
            $row->tinggi_cm ?? '-',
            $row->perkiraan_tinggi ?? '-',
            $row->jumlah_daun ?? '-',
            $row->kondisi_daun ?? '-',
            $row->cabang_baru ?? '-',
            $row->kerusakan ?? '-',
            $tindakanLabel,
            $row->catatan ?? '-',
            $row->foto ? asset('storage/' . $row->foto) : '-',
        ];
    }
}
