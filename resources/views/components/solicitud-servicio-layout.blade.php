<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Confirmación de Solicitud de Servicio' }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #1a1a1a;
            color: #f0f0f0;
            
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #2a2a2a;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #444;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        .header {
            background: linear-gradient(135deg, #70d40c, #6a58f5);
            padding: 30px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        .content {
            padding: 30px;
            line-height: 1.6;
            color: #f0f0f0
        }
        .content p {
            margin: 0 0 15px;
            font-size: 16px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            margin-bottom: 25px;
        }
        .details-table th, .details-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        .details-table th {
            background-color: #333;
            color: #70d40c;
            font-weight: bold;
            width: 40%;
        }
        .details-table td {
            color: #f0f0f0;
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
        }
        .button {
            display: inline-block;
            background-color: #9900cc;
            color: #ffffff;
            padding: 15px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .footer {
            background-color: #222;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
            border-top: 3px solid #70d40c;
        }
        .footer a {
            color: #70d40c;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        {{ $slot }}
    </div>
</body>
</html>