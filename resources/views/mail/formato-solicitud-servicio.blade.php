@php
    $fieldLabels = [
            'company_name'    => 'Nombre de la empresa',
            'company_field'   => 'Giro de la empresa',
            'company_role'    => 'Puesto en la Empresa',
            'company_size'    => 'Tamaño de la Empresa',
            'website'         => 'Sitio Web Actual y/o Red Social Principal',
            'project_details' => 'Principal desafío o proyecto',
            'budget'          => 'Presupuesto Estimado',
            'urgency'         => 'Nivel de Urgencia',
        ]; 
@endphp
<x-solicitud-servicio-layout>
    <x-slot:title>
        Confirmación de Solicitud: {{ $order->folio }}
    </x-slot>

    <div class="header">
        <h1>¡Hemos Recibido su Solicitud!</h1>
    </div>

    <div class="content">
        <p>Hola <span style="color: #70d40c">{{ $order->user->name }}</span>,</p>
        <p>Gracias por confiar en DuranMKT. Hemos recibido correctamente su solicitud de servicio con el folio <strong style="color: #70d40c;">{{ $order->folio }}</strong>. Nuestro equipo la revisará a la brevedad y se pondrá en contacto usted.</p>
        
        <h2 style="color: #70d40c; border-bottom: 2px solid #444; padding-bottom: 10px; margin-top: 30px;">Detalles de su Solicitud</h2>

        <table class="details-table">
            <tr>
                <th>Servicio Solicitado:</th>
                <td>{{ $order->product->first()->producto->name }}</td>
            </tr>
            {{-- @foreach ($fieldLabels as $key => $label)
                @if (isset($order->product->opciones[$label]) && !empty($order->product->opciones[$label]))
                    <tr>
                        <th>{{ $label }}:</th>
                        <td>{{ $order->service->options[$key] }}</td>
                    </tr>
                @endif
            @endforeach --}}
            @foreach ($order->product->first()->opciones as $field)
                <tr>
                        <th>{{ $field->option_name }}:</th>
                        <td>{{ $field->option_value }}</td>
                    </tr>
            @endforeach
        </table>

        <div class="button-container">
            <a href="{{ route('user.dash') }}" class="button" style="color: #ffffff !important; text-decoration: none !important;">Ver Estado de la Solicitud</a>
        </div>
        
        <h2 style="color: #70d40c; border-bottom: 2px solid #444; padding-bottom: 10px; margin-top: 40px;">¿Preguntas?</h2>
        <p>Si tiene alguna duda o necesita realizar un cambio, no dude en contactarnos. Por favor, tenga a la mano su folio de solicitud.</p>
        <p>
            <strong>Email:</strong> <a href="mailto:Durannogales@gmail.com" style="color: #70d40c;">Durannogales@gmail.com</a><br>
            <strong>Teléfono/WhatsApp:</strong> <a href="https://wa.me/{{ env('WHATSAPP_SUPPORT_NUMBER') }}" style="color: #70d40c;">{{ env('WHATSAPP_SUPPORT_NUMBER') }}</a>
        </p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} DuranMKT. Todos los derechos reservados.</p>
        <p><a href="{{ route('store.main') }}">Visita nuestra tienda</a></p>
    </div>

</x-solicitud-servicio-layout>