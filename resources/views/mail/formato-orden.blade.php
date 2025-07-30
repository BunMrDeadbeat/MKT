<x-order-confirmation-client-mail-layout>
    <x-slot:title>
        Pedido Confirmado: {{ $order->folio }}
    </x-slot>
    <div class="container">
        <div class="header">
            <h1>¡Su confirmación de orden DuranMKT!</h1>
            <p>¡Gracias por su preferencia!. Revisaremos su solicitud lo mas pronto posible.</p>
        </div>

        <div class="content">
            <p>Hola {{ $order->user->name }},</p>
            <p>Su solicitud con número de folio <strong style="color: #70d40c;">{{ $order->folio }}</strong> se ha ingresado a nuestro sistema y nos pondremos en contacto lo más pronto posible.</p>

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
                        @foreach ($order->product as $orderItem)
                            <tr>
                                <td>{{$orderItem->producto->name}}</td>
                                <td>{{ $orderItem->cantidad }}</td>
                            <td>
                                @if($orderItem->precio_unitario>0 && !is_null($orderItem->precio_unitario) && optional($orderItem->opciones->where('option_name', 'no_cotizacion')->first())->option_value == '1')
                                    ${{number_format($orderItem->precio_unitario, 2)}}
                                @else
                                    Pendiente
                                @endif
                            </td>
                            <td>
                                @if($orderItem->precio_unitario>0 && !is_null($orderItem->precio_unitario) && optional($orderItem->opciones->where('option_name', 'no_cotizacion')->first())->option_value == '1')
                                    ${{number_format($orderItem->precio_unitario*$orderItem->cantidad, 2)}}
                                @else
                                    Pendiente
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3">Pronto nos pondremos en contacto con usted.</td>
                            {{-- <td colspan="3">Total + IVA</td>
                            <td>${{ number_format($order->monto, 2) }}</td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>

            <p style="text-align: center; margin-top: 30px;">
                <a href="{{ route('main') }}" class="button">¡Revise el estado de su solicitud!</a>
            </p>


            <div class="separator"></div>

            <h2>¿Necesita ayuda?</h2>
            <p>Si tiene preguntas o necesita realizar cambios, ¡No dude en contactarnos!</p>
            <p>
                Email: <a href="mailto:[YOUR_SUPPORT_EMAIL]" style="color: #70d40c;">[CORREO_DE_SOPORTE]</a><br>
                Telefono: <a href="tel:[YOUR_SUPPORT_PHONE]" style="color: #70d40c;">[NUMERO_DE_SOPORTE]</a>
            </p>
            <p>Por favor mencione su folio de orden: <strong style="color: #70d40c;">{{ $order->folio }}</strong></p>
        </div>

        <div class="footer">
            <p> {{ Date('Y') }} DuranMKT. Derechos reservados. | <a href="{{ route('store.main') }}">Visita nuestra tienda</a></p>
        </div>
    </div>
</x-order-confirmation-client-mail-layout>
