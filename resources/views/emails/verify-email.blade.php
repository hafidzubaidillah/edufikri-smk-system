<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verifikasi Email - {{ $appName }}</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset styles */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        /* Main styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            width: 100% !important;
            min-width: 100%;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }
        
        .logo {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 8px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .tagline {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }
        
        .content {
            padding: 40px 30px;
        }
        
        .welcome-title {
            font-size: 24px;
            font-weight: bold;
            color: #1a202c;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .user-name {
            color: #667eea;
            font-weight: 600;
        }
        
        .message {
            font-size: 16px;
            line-height: 1.7;
            color: #4a5568;
            margin-bottom: 30px;
        }
        
        .cta-container {
            text-align: center;
            margin: 40px 0;
        }
        
        .cta-button {
            display: inline-block;
            padding: 16px 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }
        
        .security-notice {
            background-color: #fef5e7;
            border-left: 4px solid #f6ad55;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
        }
        
        .security-title {
            font-weight: bold;
            color: #c05621;
            margin-bottom: 10px;
        }
        
        .security-list {
            margin: 10px 0;
            padding-left: 20px;
            color: #744210;
        }
        
        .backup-url {
            word-break: break-all;
            font-size: 12px;
            color: #718096;
            background-color: #f7fafc;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }
        
        .footer {
            background-color: #f7fafc;
            text-align: center;
            padding: 30px 20px;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-text {
            color: #718096;
            font-size: 14px;
            margin: 5px 0;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-link {
            display: inline-block;
            margin: 0 10px;
            color: #667eea;
            text-decoration: none;
        }
        
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 8px;
            }
            .content {
                padding: 30px 20px;
            }
            .header {
                padding: 30px 20px;
            }
            .logo {
                font-size: 28px;
            }
            .cta-button {
                padding: 14px 28px;
                font-size: 15px;
            }
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .email-container {
                background-color: #2d3748;
            }
            .content {
                color: #e2e8f0;
            }
            .welcome-title {
                color: #f7fafc;
            }
            .message {
                color: #cbd5e0;
            }
        }
    </style>
</head>
<body>
    <div style="padding: 20px 0;">
        <div class="email-container">
            <div class="header">
                <div class="logo">{{ $appName }}</div>
                <p class="tagline">Learning Management System</p>
            </div>
            
            <div class="content">
                <h1 class="welcome-title">Verifikasi Email Anda</h1>
                
                <p class="message">
                    Halo <span class="user-name">{{ $user->name }}</span>,
                </p>
                
                <p class="message">
                    Selamat datang di <strong>{{ $appName }}</strong>! Terima kasih telah bergabung dengan Learning Management System kami. 
                    Untuk melengkapi proses registrasi dan mengakses semua fitur pembelajaran, silakan verifikasi alamat email Anda.
                </p>
                
                <div class="cta-container">
                    <a href="{{ $verificationUrl }}" class="cta-button">
                        ✉️ Verifikasi Email Saya
                    </a>
                </div>
                
                <div class="security-notice">
                    <div class="security-title">🔒 Informasi Keamanan</div>
                    <ul class="security-list">
                        <li>Link verifikasi ini akan kedaluwarsa dalam <strong>{{ $expireMinutes }} menit</strong></li>
                        <li>Link hanya dapat digunakan sekali</li>
                        <li>Jika tombol tidak berfungsi, salin URL di bawah ini ke browser Anda</li>
                    </ul>
                    <div class="backup-url">{{ $verificationUrl }}</div>
                </div>
                
                <p class="message">
                    Setelah verifikasi berhasil, Anda akan dapat:
                </p>
                <ul style="color: #4a5568; line-height: 1.7;">
                    <li>📚 Mengakses semua materi pembelajaran</li>
                    <li>📊 Melihat progress dan statistik belajar</li>
                    <li>💬 Berinteraksi dengan instruktur dan sesama learner</li>
                    <li>🏆 Mendapatkan sertifikat setelah menyelesaikan kursus</li>
                </ul>
                
                <p class="message">
                    Jika Anda tidak membuat akun ini, abaikan email ini dan tidak ada tindakan lebih lanjut yang diperlukan. 
                    Akun akan otomatis dihapus jika tidak diverifikasi dalam 7 hari.
                </p>
            </div>
            
            <div class="footer">
                <p class="footer-text">Email ini dikirim secara otomatis, mohon jangan membalas.</p>
                <div class="social-links">
                    <a href="#" class="social-link">📧 Support</a>
                    <a href="#" class="social-link">🌐 Website</a>
                    <a href="#" class="social-link">📱 Mobile App</a>
                </div>
                <p class="footer-text">&copy; {{ date('Y') }} {{ $appName }}. Semua hak dilindungi.</p>
                <p class="footer-text" style="font-size: 12px; margin-top: 15px;">
                    Dikirim pada {{ now()->format('d F Y, H:i') }} WIB
                </p>
            </div>
        </div>
    </div>
</body>
</html>