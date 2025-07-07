<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botanik Bahçesi Haberleri</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td {
            padding: 0;
            text-align: left;
            vertical-align: top;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            border: 0;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1F2937;
            padding: 24px;
            text-align: center;
        }

        .header img {
            max-width: 150px;
            margin: 0 auto 16px auto;
        }

        .header h1 {
            color: #ffffff;
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .header p {
            color: #9CA3AF;
            font-size: 16px;
            margin: 8px 0 0 0;
        }

        .content-section {
            padding: 24px 32px;
            color: #374151;
            line-height: 1.6;
        }

        .content-section h2 {
            color: #1F2937;
            font-size: 24px;
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 16px;
        }

        .content-section p {
            margin-bottom: 16px;
        }

        .content-section ul {
            list-style: none;
            padding: 0;
            margin: 0 0 16px 0;
        }

        .content-section ul li {
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .content-section ul li::before {
            content: '🌿';
            position: absolute;
            left: 0;
            color: #4B5563;
        }


        .button-wrapper {
            text-align: center;
            padding: 24px 32px;
        }

        .button {
            display: inline-block;
            background-color: #1F2937;
            color: #ffffff !important;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .button:hover {
            background-color: #374151;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }


        .image-wrapper {
            padding: 0 32px 24px 32px;
            text-align: center;
        }

        .image-wrapper img {
            border-radius: 8px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
        }


        .footer {
            background-color: #e5e7eb;
            padding: 20px 32px;
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .footer a {
            color: #6b7280;
            text-decoration: underline;
        }


        @media only screen and (max-width: 600px) {
            .container {
                margin: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .header {
                padding: 20px;
            }

            .header h1 {
                font-size: 28px;
            }

            .content-section,
            .button-wrapper,
            .image-wrapper,
            .footer {
                padding: 20px;
            }

            .button {
                padding: 10px 24px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table class="container" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="header">
                            <h1>İçe Aktarma İşleminde Hata Oluştu</h1>
                            <p>Aksesyon defteri verileriniz kısmen veya tamamen işlenemedi.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="content-section">
                            <h2>İçe Aktarma İşlemi Başarısız Oldu (Kısmen/Tamamen)</h2>
                            <p>Botanik Bahçesi sisteminde başlattığınız "Aksesyon Defteri" içe aktarma işlemi sırasında
                                bazı hatalarla karşılaşıldı. Bu nedenle, dosyanızdaki tüm veriler veya bir kısmı
                                başarıyla işlenemedi.</p>
                            <p>Aşağıda tespit edilen hata detaylarını bulabilirsiniz:</p>

                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                style="margin-top: 20px; margin-bottom: 20px; background-color: #ffebeb; border: 1px solid #ef4444; border-radius: 6px; padding: 15px;">
                                <tr>
                                    <td>
                                        <h3
                                            style="color: #ef4444; font-size: 18px; margin-top: 0; margin-bottom: 10px;">
                                            Hata Detayları:</h3>
                                        <ul style="list-style: none; padding: 0; margin: 0; color: #b91c1c;">
                                            @foreach ($errors as $error)
                                                <li style="margin-bottom: 8px;">
                                                    <strong>Satır:</strong> {{ $error['row'] }}
                                                    @if (isset($error['attribute']))
                                                        , <strong>Sütun:</strong> {{ $error['attribute'] }}
                                                    @endif
                                                    , <strong>Hata:</strong> {{ implode(', ', $error['errors']) }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </table>

                            <p>Lütfen yukarıdaki hata mesajlarını inceleyerek dosyanızdaki gerekli düzenlemeleri yapınız
                                ve işlemi tekrar denemenizi rica ederiz.</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            <p>&copy; 2025 Sürgün. Tüm Hakları Saklıdır.</p>
                            <p><a href="#">İletişim</a> | <a href="#">Gizlilik Politikası</a></p>
                            <p>Bu e-posta, Sürgün sistemine kaydınızla ilgili otomatik olarak gönderilmiştir.
                                Lütfen bu e-postayı kimseyle paylaşmayın.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
