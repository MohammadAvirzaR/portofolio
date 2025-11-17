<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Baru Diterima</title>
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
        .info-box {
            background-color: #f8f9ff;
            padding: 15px;
            border-left: 4px solid #667eea;
            margin: 15px 0;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            background-color: #667eea;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }
        .btn:hover {
            background-color: #764ba2;
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
            <h2>📋 Lamaran Baru Diterima</h2>
        </div>

        <div class="content">
            <p>Halo Admin,</p>

            <p>Anda telah menerima lamaran baru dari pelamar berikut:</p>

            <div class="info-box">
                <p><strong>Nama Pelamar:</strong> {{ $applicantName }}</p>
                <p><strong>Posisi:</strong> {{ $jobTitle }}</p>
            </div>

            <p>Anda dapat mengunduh CV pelamar dengan mengklik tombol di bawah:</p>

            <center>
                <a href="{{ $cvUrl }}" class="btn">
                    ⬇️ Download CV Pelamar
                </a>
            </center>

            <p style="margin-top: 20px;">Atau copy link berikut:</p>
            <p style="word-break: break-all; background-color: #f5f5f5; padding: 10px; border-radius: 4px;">
                {{ $cvUrl }}
            </p>

            <p style="margin-top: 20px;">Segera periksa dan proses lamaran tersebut di dashboard admin Anda.</p>

            <p>Terima kasih,<br>
            <strong>Sistem Informasi Rekrutmen</strong></p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Job Portal. Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
