@component('mail::message')
    <p>Kính thưa {{ $order->first_name }}, </p>
    <p>Trạng thái đơn hàng: <b>
            @if ($order->status == 0)
                Chờ xác nhận
            @elseif($order->status == 1)
                Đang xử lý
            @elseif($order->status == 2)
                Đang vận chuyển
            @elseif($order->status == 3)
                Giao hàng thành công
            @elseif($order->status == 4)
                Đã hủy
            @endif
        </b>
    </p>
    <h3>Hóa đơn chi tiết:</h3>
    <ul>
        <li>Số đơn hàng: {{ $order->order_number }}</li>
        <li>Ngày mua: {{ date('d-m-Y', strtotime($order->created_at)) }}</li>
    </ul>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr>
                <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Tên sản phẩm</th>
                <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left;">Số lượng</th>
                <th style="border-bottom: 1px solid #ddd; padding: 8px; text-align: left; ">Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->getItem as $item)
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">
                        {{ $item->getProduct->title }}
                        <br>Màu sắc: {{ $item->color_name }}
                        @if (!empty($item->size_name))
                            <br>Size: {{ $item->size_name }}
                        @endif
                    </td>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">{{ $item->quantity }}</td>
                    <td style="padding: 8px; border-bottom: 1px solid #ddd;">₫ {{ number_format($item->total_price) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Phí vận chuyển: ₫{{ number_format($order->shipping_amount) }}</p>
    @if (!empty($order->discount_amount))
        <p>Giảm giá: ₫{{ number_format($order->discount_amount) }}</p>
    @endif
    <p>Tổng cộng: ₫{{ number_format($order->total_amount) }}</p>
    <p style="text-transform: capitalize;">Phương thức thanh toán: <b>{{ $order->payment_method }}</b></p>
    <p>Cảm ơn bạn về sự lựa chọn <strong>Trendy Threads</strong>.</p>
    {{ config('app.name') }}
@endcomponent
