@foreach($orders as $order)
    <tr>
        <td>{{ $order->customer_name }}</td>
        <td>{{ $order->customer_email }}</td>
        <td>{{ $order->total_price }}</td>
        <td>{{ $order->financial_status }}</td>
        <td>{{ $order->fulfillment_status }}</td>
    </tr>
@endforeach