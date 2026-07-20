<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat My Cemara - {{ $pohon->kode_pohon }}</title>
</head>
<body style="font-family: 'Times New Roman', Georgia, serif; text-align: center; padding: 40px; color: #1e293b;">
    <div style="border: 6px double #065f46; padding: 40px; border-radius: 10px;">
        <h1 style="color: #065f46; font-size: 28pt; margin-bottom: 5px; text-transform: uppercase;">SERTIFIKAT ADOPSI POHON</h1>
        <h3 style="color: #047857; font-size: 14pt; margin-top: 0; text-transform: uppercase;">My Cemara &mdash; Pantai Karangjahe, Desa Punjulharjo</h3>
        
        <hr style="border: 0; border-top: 2px solid #047857; width: 60%; margin: 30px auto;" />

        <p style="font-size: 12pt; color: #64748b; text-transform: uppercase; tracking: 2px;">Diberikan Kepada:</p>
        <h2 style="font-size: 24pt; color: #0f172a; text-decoration: underline; margin: 20px 0;">{{ $pohon->nama_sertifikat }}</h2>

        <p style="font-size: 13pt; line-height: 1.6; max-width: 600px; margin: 20px auto; color: #334155;">
            Atas dedikasi dan kontribusi aktif dalam pelestarian ekosistem pesisir melalui adopsi bibit 
            <strong>Cemara Laut (Casuarina equisetifolia)</strong> di Pantai Karangjahe, Desa Wisata Punjulharjo.
        </p>

        <table style="margin: 30px auto; text-align: left; border-collapse: collapse; width: 80%; background-color: #f0fdf4; border: 1px solid #bbf7d0;">
            <tr>
                <td style="padding: 10px; border: 1px solid #bbf7d0;"><strong>Kode Pohon Unik</strong></td>
                <td style="padding: 10px; border: 1px solid #bbf7d0; font-family: monospace; font-size: 13pt; color: #065f46; font-weight: bold;">{{ $pohon->kode_pohon }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #bbf7d0;"><strong>Status Tanam</strong></td>
                <td style="padding: 10px; border: 1px solid #bbf7d0;">{{ ucfirst($pohon->status) }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border: 1px solid #bbf7d0;"><strong>Tanggal Penanaman</strong></td>
                <td style="padding: 10px; border: 1px solid #bbf7d0;">{{ optional($pohon->tanggal_tanam)->format('d-m-Y') ?? 'Dalam Pengawasan Tim Desa' }}</td>
            </tr>
        </table>

        <br/><br/>
        <table style="width: 100%; margin-top: 40px; text-align: center;">
            <tr>
                <td style="width: 50%;">
                    <p style="font-size: 11pt; margin-bottom: 60px;">Tim Pengelola Pesisir</p>
                    <p style="font-weight: bold; border-top: 1px solid #94a3b8; display: inline-block; padding-top: 5px; width: 200px;">Pokdarwis Karangjahe</p>
                </td>
                <td style="width: 50%;">
                    <p style="font-size: 11pt; margin-bottom: 60px;">Pemerintah Desa</p>
                    <p style="font-weight: bold; border-top: 1px solid #94a3b8; display: inline-block; padding-top: 5px; width: 200px;">Desa Punjulharjo</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
