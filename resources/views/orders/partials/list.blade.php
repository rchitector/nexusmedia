@foreach($orders as $order)
    <tr>
        <td>{{ $order?->customer?->first_name }} {{ $order?->customer?->last_name }}</td>
        <td>{{ $order?->customer?->email }}</td>
        <td>{{ $order?->total_price }}</td>
        <td>{{ $order?->financial_status }}</td>
        <td>{{ $order?->fulfillment_status }}</td>
    </tr>
@endforeach