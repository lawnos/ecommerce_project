@extends('layouts.app')
@section('style')
    <style>
        .content-wrapper {
            padding: 20px;
        }

        .card-header {

            color: #000000;
            /* font-weight: bold; */
            text-align: left;
        }

        .card-body {
            padding: 20px;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group p {
            margin: 0;
            padding: 5px;
            border-radius: 5px;
            background-color: #d1d3d4;
            font-weight: normal;
            /* Đảm bảo chữ trong thẻ p không in đậm */
        }
    </style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center" style="background-image: url('client/assets/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Chi Tiết Đơn Hàng</h1>
            </div>
        </div>

        <br>
        <br>

        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <div class="row">
                        @include('user.sidebar')
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                @include('layouts.message')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>ID:</label>
                                        <p>{{ $getRecord->order_number ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>ID giao dịch:</label>
                                        <p>{{ $getRecord->transaction_id ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên:</label>
                                        <p>{{ $getRecord->first_name }} {{ $getRecord->last_name }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên công ty:</label>
                                        <p>{{ $getRecord->company_name ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Quận:</label>
                                        <p>{{ $getRecord->county ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ:</label>
                                        <p>Địa chỉ 1: {{ $getRecord->address_one ?? 'Không có' }}<br>Địa chỉ 2:
                                            {{ $getRecord->address_two ?? 'Không có' }}
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Thành phố:</label>
                                        <p>{{ $getRecord->city ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tình trạng:</label>
                                        <p>{{ $getRecord->state ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã bưu chính:</label>
                                        <p>{{ $getRecord->postcode ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại:</label>
                                        <p>{{ $getRecord->phone ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <p>{{ $getRecord->email ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã giảm giá:</label>
                                        <p>{{ $getRecord->discount_code ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Số tiền giảm giá:</label>
                                        <p>₫{{ number_format($getRecord->discount_amount) ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Loại vận chuyển:</label>
                                        <p>{{ $getRecord->getShipping->name ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Số tiền vận chuyển:</label>
                                        <p>₫{{ number_format($getRecord->shipping_amount) ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Tổng cộng:</label>
                                        <p>₫{{ number_format($getRecord->total_amount) ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Phương thức thanh toán:</label>
                                        <p>{{ $getRecord->payment_method ?? 'Không có' }}</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái:</label>
                                        <p>
                                            @if ($getRecord->status == 0)
                                                Chờ xác nhận
                                            @elseif($getRecord->status == 1)
                                                Đang xử lý
                                            @elseif($getRecord->status == 2)
                                                Đang vận chuyển
                                            @elseif($getRecord->status == 3)
                                                Giao hàng thành công
                                            @elseif($getRecord->status == 4)
                                                Đã hủy
                                            @endif
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày tạo:</label>
                                        <p>{{ date('d-m-Y h:i A', strtotime($getRecord->created_at)) ?? 'Không có' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <br>
                                    <div class="card-header">
                                        <h5>Chi tiết sản phẩm</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Hình ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                    <th>Tổng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($getRecord->getItem as $item)
                                                        @php
                                                            $getProductImage = $item->getProduct->getImageSingle(
                                                                $item->getProduct->id,
                                                            );
                                                        @endphp

                                                        <td><img src="{{ $getProductImage->getLogo() }}" alt=""
                                                                width="120px"></td>
                                                        <td><a target="_blank"
                                                                href="{{ url($item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                                                            <br>

                                                            @if (!empty($item->size_name))
                                                                <b>Size:</b> {{ $item->size_name }}
                                                            @endif

                                                            <br>

                                                            @if (!empty($item->color_name))
                                                                <b>Màu sắc:</b> {{ $item->color_name }}
                                                            @endif

                                                            <br>

                                                            @if ($getRecord->status == 3)
                                                                @php
                                                                    $getReview = $item->getReview(
                                                                        $item->getProduct->id,
                                                                        $getRecord->id,
                                                                    );
                                                                @endphp

                                                                @if (!empty($getReview))
                                                                    <b>Chất lượng:</b>
                                                                    @if ($getReview->rating == 0)
                                                                        Tệ
                                                                    @elseif($getReview->rating == 1)
                                                                        Không hài lòng
                                                                    @elseif($getReview->rating == 2)
                                                                        Bình thường
                                                                    @elseif($getReview->rating == 3)
                                                                        Hài lòng
                                                                    @elseif($getReview->rating == 4)
                                                                        Tuyệt vời
                                                                    @endif <br>
                                                                    <b>Mô tả đánh giá:</b> {{ $getReview->review }}
                                                                @else
                                                                    <button class="btn btn-primary MakeReview"
                                                                        id="{{ $item->getProduct->id }}"
                                                                        data-order={{ $getRecord->id }}>Đánh Giá</button>
                                                                @endif
                                                            @endif
                                                        </td>

                                                        <td>{{ $item->quantity }}</td>
                                                        <td>₫ {{ number_format($item->price) }}</td>
                                                        <td>₫ {{ number_format($item->total_price) }}</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="MakeReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Đánh giá</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('user/make-review') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" id="getProductId" name="product_id" required>
                    <input type="hidden" id="getOrderId" name="order_id" required>

                    <div class="modal-body" style="padding: 20px">
                        <div class="form-group">
                            <label for="">Chất lượng sản phẩm!</label>
                            <select class="form-control" name="rating" required>
                                <option value="">Chọn</option>
                                <option value="0">Tệ</option>
                                <option value="1">Không hài lòng</option>
                                <option value="2">Bình thường</option>
                                <option value="3">Hài lòng</option>
                                <option value="4">Tuyệt vời</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả đánh giá!</label>
                            <textarea name="review" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('body').delegate('.MakeReview', 'click', function() {
            var product_id = $(this).attr('id');
            var order_id = $(this).attr('data-order');

            $('#getProductId').val(product_id);
            $('#getOrderId').val(order_id);

            $('#MakeReviewModal').modal('show');
        });
    </script>
@endsection
