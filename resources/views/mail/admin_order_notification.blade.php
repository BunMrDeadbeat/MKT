<!DOCTYPE html>
<html>
<head>
    <title>Nueva Orden Recibida</title>
</head>
<body>
    <h1>Nueva Orden Recibida</h1>
    <p>Se ha recibido una nueva orden con el folio: <strong>{{ $order->folio }}</strong></p>
    
    <h2>Detalles del Cliente</h2>
    <ul>
        <li><strong>Nombre:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Teléfono:</strong> @php
    $telefono = $user->telefono;
    $displayTelefono = $telefono; // Valor por defecto

    if ($telefono && !str_starts_with($telefono, '+1')) {
        // Primero, intenta hacer match con el formato de celular mexicano (+521... o 521...)
        $formatted = preg_replace('/^(\+?52)1(\d{10})$/', '$1$2', $telefono);
        
        if ($formatted !== $telefono) {
            $displayTelefono = $formatted;
        } 
        // Si no, revisa si es un número de 11 dígitos que empieza con 1
        elseif (strlen($telefono) === 11 && str_starts_with($telefono, '1')) {
            $displayTelefono = substr($telefono, 1);
        }
    }
    echo e($displayTelefono); // Imprime el número formateado de forma segura
@endphp
</li>
    </ul>

    <h2>Detalles de la Orden</h2>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->product as $item)
                <tr>
                    <td>{{ $item->producto->name }}
                        @if ($item->opciones->count() > 0)
                            <br>
                            <small>
                                <ul>
                                    @foreach ($item->opciones as $opcion)
                                        @if($opcion->option_name=='no_cotizacion')
                                            @continue
                                        @endif
                                        <li><strong>{{ $opcion->option_name }}:</strong> {{ $opcion->option_value }}</li>
                                    @endforeach
                                </ul>
                            </small>
                        @endif
                    </td>
                    
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ number_format($item->precio_unitario, 2) }}</td>
                    <td>${{ number_format($item->precio_unitario * $item->cantidad, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
     <h2>Metodo de Pago preferido</h2>
        <ul><li><strong>{{ $order->metodo_pago }}</strong></li></ul>
    <p>
        <a href="{{ route('admin.orders.details', $order->id) }}">Ver detalles de la orden en el panel de administración</a>
    </p>
</body>
</html>