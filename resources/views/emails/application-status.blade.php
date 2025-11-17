<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Lamaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h2 {
            margin: 0;
        }
        .content {
            padding: 20px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            margin: 15px 0;
        }
        .status-accepted {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        .info-box {
            background-color: #f8f9ff;
            padding: 15px;
            border-left: 4px solid #667eea;
            margin: 15px 0;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>📨 Update Status Lamaran</h2>
        </div>

        <div class="content">
            <p>Halo {{ $name }},</p>

            <p>Kami dengan senang hati menginformasikan bahwa status lamaran Anda telah diperbarui. Berikut adalah rinciannya:</p>

            <div class="info-box">
                <p><strong>Posisi:</strong> {{ $jobTitle }}</p>
                <p><strong>Status Lamaran:</strong></p>
                <div class="status-badge status-{{ strtolower($status) }}">
                    {{ $status }}
                </div>
            </div>

            @if(strtolower($status) === 'accepted')
                <p>🎉 Selamat! Lamaran Anda telah <strong>diterima</strong>. Tim kami akan segera menghubungi Anda untuk tahap selanjutnya.</p>
            @elseif(strtolower($status) === 'rejected')
                <p>Terima kasih telah melamar untuk posisi ini. Sayangnya, lamaran Anda pada kesempatan kali ini belum bisa kami lanjutkan ke tahap berikutnya. Kami menghargai minat Anda dan mendorong Anda untuk melamar pada kesempatan yang lain di masa depan.</p>
            @else
                <p>Lamaran Anda masih dalam tahap review. Kami akan segera memberikan informasi lebih lanjut.</p>
            @endif

            <p style="margin-top: 20px;">Anda dapat melihat status lamaran Anda secara lengkap di dashboard "Aplikasi Saya" pada website kami.</p>

            <p style="margin-top: 20px;">Terima kasih atas perhatian Anda,<br>
            <strong>Tim Rekrutmen</strong></p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Job Portal. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
