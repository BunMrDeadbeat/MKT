<x-mail::message>
Tu pedido está listo!
Hola {{ $order->user->name }},

Te informamos que tu pedido con folio {{ $order->folio }} ha sido completado y ya está listo para que pases a recogerlo.

Resumen del Pedido:

Folio: {{ $order->folio }}

Fecha: {{ $order->created_at->format('d/m/Y') }}

Total: ${{ number_format($order->monto, 2) }}

Puedes pasar a nuestra sucursal en el horario habitual. Si tu pedido requiere pago, puedes realizarlo al momento de la entrega.

<x-mail::button :url="$url">
Ver Detalles de mi Orden
</x-mail::button>

Gracias por tu compra,<br>
{{ config('app.name') }}
</x-mail::message>
