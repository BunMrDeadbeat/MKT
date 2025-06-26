<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Spooktacular Order Confirmation!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&family=Open+Sans:wght@400;700&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a; /* Dark background for a spooky feel */
            color: #f0f0f0; /* Light text for contrast */
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #333; /* Slightly lighter dark background for content */
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            border: 2px solid #70d40c; /* Orange border for Halloween pop */
        }
        .header {
            background-color: #70d40c; /* Halloween orange */
            padding: 20px;
            text-align: center;
            color: #fff;
            position: relative;
        }
        .header h1 {
            font-family: 'Tahoe', semibold; /* Spooky font */
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
            background-color: #9900cc; /* Deep purple for accent */
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
<body>
    <div class="container">
        <div class="header">
            <h1>¡Su confirmación de orden DuranMKT!</h1>
            <p>¡Gracias por su preferencia!. Revisaremos su solicitud lo mas pronto posible.</p>
        </div>

        <div class="content">
            <p>Hola {{ $order->user->name }},</p>
            <p>Su solicitud <strong style="color: #70d40c;">#{{$order->id}}D{{ $order->producto_id }}MKT{{$order->user_id}}</strong> se ha ingresado a nuestro sistema y nos pondremos en contacto lo más pronto posible</p>

            <div class="separator"></div>

            <h2> Detalles de solicitud</h2>
            <div class="order-details">
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>1</td>
                            <td>
                                @if(!is_null($order->product->price))
                                    ${{$order->product->price}}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(!is_null($order->product->price))
                                    ${{$order->product->price}}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>[Producto 2 nombre]</td>
                            <td>[Cantidad 2]</td>
                            <td>$[Precio 2.00]</td>
                            <td>$[Subtotal 2.00]</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="3">IVA</td>
                            <td>${{ number_format($order->product->price * 0.16, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td colspan="3">Total</td>
                            <td>${{ number_format($order->product->price + ($order->product->price * 0.16), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ route('main') }}" class="button">¡Revise el estado!</a>
            </p>


            <div class="separator"></div>

            <h2>¿Necesita ayuda?</h2>
            <p>Si tiene preguntas o necesita realizar cambios, ¡No dude en contactarnos!</p>
            <p>
                Email: <a href="mailto:[YOUR_SUPPORT_EMAIL]" style="color: #70d40c;">[CORREO_DE_SOPORTE]</a><br>
                Telefono: <a href="tel:[YOUR_SUPPORT_PHONE]" style="color: #70d40c;">[NUMERO_DE_SOPORTE]</a>
            </p>
            <p>Por favor mencione su numero de solicitud: <strong style="color: #70d40c;">#{{$order->id}}D{{ $order->producto_id }}MKT{{$order->user_id}}</strong></p>
        </div>

        <div class="footer">
            <p>&copy; {{ Date('Y') }} DuranMKT. Derechos reservados. | <a href="{{ route('store.main') }}">Visita nuestra tienda</a></p>
        </div>
    </div>
</body>
</html>