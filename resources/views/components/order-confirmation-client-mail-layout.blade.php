<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu confirmación de orden</title>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #333; 
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            border: 2px solid #70d40c;
        }
        .header {
            background-color: #70d40c;
            padding: 20px;
            text-align: center;
            color: #fff;
            position: relative;
        }
        .header h1 {
            font-family: 'Tahoe', semibold;
            margin: 0;
            font-size: 36px;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .header p {
            font-size: 18px;
            margin-top: 5px;
        }
        .content {
            padding: 20px 30px;
            line-height: 1.6;
            color: #f0f0f0;
        }
        .content h2 {
            font-family: 'Tahoe', semibold;
            color: #70d40c;
            font-size: 28px;
            border-bottom: 1px dashed #555;
            padding-bottom: 10px;
            margin-top: 30px;
            text-align: center;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .order-details th, .order-details td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #444;
            color: #f0f0f0;
        }
        .order-details th {
            background-color: #444;
            color: #70d40c;
            font-weight: bold;
        }
        .order-details .total-row td {
            font-weight: bold;
            font-size: 18px;
            color: #70d40c;
            border-top: 2px solid #70d40c;
        }
        .button {
            display: inline-block;
            background-color: #9900cc; 
            color: #fff;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #660099;
        }
        .footer {
            background-color: #222;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #aaa;
            border-top: 2px solid #70d40c;
        }
        .footer a {
            color: #70d40c;
            text-decoration: none;
        }
        .separator {
            height: 10px;
            background: repeating-linear-gradient(
                45deg,
                #70d40c,
                #70d40c 5px,
                #9900cc 5px,
                #9900cc 10px
            );
            margin: 20px 0;
        }
        

        @media only screen and (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 0;
            }
            .content {
                padding: 15px;
            }
            .header h1 {
                font-size: 30px;
            }
            .content h2 {
                font-size: 24px;
            }
            .order-details th, .order-details td {
                padding: 8px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body style="font-family: sans-serif; color: #333;">
    {{ $slot }}
</body>
</html>