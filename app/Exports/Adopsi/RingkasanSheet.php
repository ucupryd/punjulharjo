<?php

namespace App\Exports\Adopsi;

use App\Models\CemaraAdopsi;
use App\Models\CemaraPohon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RingkasanSheet implements FromArray, WithHeadings, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Ringkasan';
    }

    public function headings(): array
    {
        return ["Ringkasan", "Nilai"];
    }

    public function array(): array
    {
        $statusLunas = ['diverifikasi', 'ditanam', 'selesai'];

        $totalDana = CemaraAdopsi::whereIn('status', $statusLunas)->sum('total_harga');
        $totalDanaDonasi = CemaraAdopsi::whereIn('status', $statusLunas)
            ->whereHas('paket', fn($q) => $q->where('is_donasi', true))
            ->sum('total_harga');
        $totalTransaksi = CemaraAdopsi::count();
        $totalPohon = CemaraPohon::count();
        $totalMember = CemaraAdopsi::whereNotNull('user_id')->distinct('user_id')->count('user_id');

        $breakdownPaket = CemaraAdopsi::with('paket')
            ->whereIn('status', $statusLunas)
            ->get()
            ->groupBy('paket_id')
            ->map(function ($group) {
                return [
                    'nama' => $group->first()->paket->nama ?? '-',
                    'jumlah_transaksi' => $group->count(),
                    'total_dana' => $group->sum('total_harga'),
                ];
            });

        $rows = [
            ["Total Dana Terkumpul (Rp)", $totalDana],
            ["  - dari Donasi Paket C (Rp)", $totalDanaDonasi],
            ["Total Transaksi", $totalTransaksi],
            ["Total Pohon Ditanam", $totalPohon],
            ["Total Member Aktif", $totalMember],
            ["", ""],
            ["Breakdown per Paket", ""],
        ];
        foreach ($breakdownPaket as $item) {
            $rows[] = [$item['nama'], "{$item['jumlah_transaksi']} transaksi / Rp " . number_format($item['total_dana'])];
        }
        return $rows;
    }
}
