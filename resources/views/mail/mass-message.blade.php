<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Mensaje de Contacto</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f4f4f4;">
        <tr>
            <td align="center">
                <table width="600" border="0" cellspacing="0" cellpadding="0" style="background-color: #ffffff; margin: 20px 0; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <tr>
                        <td align="center" style="padding: 20px 0; background-color: #3c9018; color: #ffffff; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h1 style="margin: 0; font-size: 24px;">Nuevo Mensaje de Contacto</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 40px; color: #333333;">
                            <h2 style="font-size: 20px; color: #13da37;">¡Has recibido un nuevo mensaje!</h2>
                            <p style="font-size: 16px; line-height: 1.6;">A continuación se muestran los detalles del mensaje enviado desde el formulario de contacto de tu landing page:</p>
                            <hr style="border: 0; border-top: 1px solid #eeeeee;">
                            <h3 style="font-size: 18px; color: #333333; margin-top: 20px;">Detalles del Contacto:</h3>
                            <p style="font-size: 16px; margin: 10px 0;"><strong>Nombre:</strong> {{ $data['name'] }}</p>
                            <p style="font-size: 16px; margin: 10px 0;"><strong>Email:</strong> {{ $data['email'] }}</p>
                            @if(!empty($data['phone']))
                                <p style="font-size: 16px; margin: 10px 0;"><strong>Teléfono:</strong> {{ $data['phone'] }}</p>
                            @endif
                            <p style="font-size: 16px; margin: 10px 0;"><strong>Servicio de Interés:</strong> {{ $data['service'] }}</p>
                            <hr style="border: 0; border-top: 1px solid #eeeeee; margin-top: 20px;">
                            <h3 style="font-size: 18px; color: #333333; margin-top: 20px;">Mensaje:</h3>
                            <p style="font-size: 16px; line-height: 1.6; background-color: #f9f9f9; border-left: 4px solid #661464; padding: 15px; margin: 0;">
                                {{ $data['message'] }}
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 20px; font-size: 12px; color: #999999; background-color: #f4f4f4; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                            <p>Este es un mensaje automático enviado desde nuestro sitio web de parte de un usuario.</p>
                            <p>&copy; {{ date('Y') }} DuranMKT. Todos los derechos reservados.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>