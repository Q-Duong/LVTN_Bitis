<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>
    <div class="container" style="background: #888;border-radius: 12px;padding:15px;">
        <div class="col-md-12">

            <p style="text-align: center;color: #fff">Đây là email tự động. Quý khách vui lòng không trả lời email này.
            </p>
            <div class="row" style="background: #fff;padding: 15px">


                <div class="col-md-6" style="text-align: center;color: #222;font-weight: bold;font-size: 25px">
                    <h3 style="margin: 0">BITI'S VIỆT NAM</h3>
                    <h4 style="margin: 10px 0">XÁC NHẬN ĐƠN ĐẶT HÀNG</h4>
                </div>

                <div class="col-md-6 logo">
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Chào bạn 
                        <strong style="color: #0071e3; text-decoration: none; font-weight: 400;">
                            {{$order -> receiver -> receiver_first_name}} {{$order -> receiver -> receiver_last_name}}.
                        </strong>
                    </p>
                </div>

                <div class="col-md-12">
                    <p style="color: #rgb(102,102,102); font-size: 17px;">Bạn đã đăng ký dịch vụ tại shop với thông tin như sau:</p>
                    <h4 style="color: #222; text-transform: uppercase; margin-top: 35px;">Thông tin đơn hàng</h4>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;"><strong>Mã đơn hàng :</strong>
                        <span style="color:#0071e3">
                            {{$order -> order_code}}
                        </span>
                    </p>
                    
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;"><strong>Dịch vụ :</strong><span style="text-transform: none;color:#0071e3">Đặt hàng trực tuyến</span></p>

                    <h4 style="color: #222; text-transform: uppercase; margin-top: 35px;">Thông tin người nhận</h4>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Email :
                        <span style="color:#0071e3">{{$order -> receiver -> receiver_email}}</span>
                    </p>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Họ và tên khách hàng :
                        <span style="color:#0071e3">{{$order -> receiver -> receiver_first_name}} {{$order -> receiver -> receiver_last_name}}.</span>
                    </p>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Địa chỉ nhận hàng :
                        <span style="color:#0071e3">
                            {{ $order -> receiver -> receiver_address }},
                            {{ $order -> receiver -> ward -> ward_name }},
                            {{ $order -> receiver -> district -> district_name }},
                            {{ $order -> receiver -> city -> city_name }}</span>
                    </p>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Số điện thoại :
                        <span style="color:#0071e3">{{$order -> receiver -> receiver_phone}}</span>
                    </p>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Ghi chú đơn hàng :
                        <span style="color:#0071e3">
                            {{$order -> receiver -> receiver_note == '' ? 'Không có thông tin' : $order -> receiver -> receiver_note}}
                        </span>
                    </p>
                    <p style="color: #rgb(102,102,102);text-transform: uppercase;">Hình thức thanh toán :
                        <span style="text-transform: none;color: #0071e3">
                            {{$order -> order_payment_type == 0 ? 'Thanh toán khi nhận hàng' : 'MoMo'}}
                        </span>
                    </p>
                    <h4 style="color: #222;text-transform: uppercase; margin-top: 35px;">Sản phẩm đã đặt</h4>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light" width="100%">
                            <thead>
                                <tr style="text-align:left;">
                                    <th>Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng đặt</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($order_detail as $order_del)
                                @php
                                $sub_total = $order_del -> wareHouse -> product -> product_price * $order_del -> order_detail_quantity;
                                @endphp
                                <tr>
                                    <td>{{$order_del -> wareHouse -> product -> product_name}}</td>
                                    <td>{{number_format($order_del -> wareHouse -> product -> product_price,0,',','.')}}₫</td>
                                    <td>{{$order_del -> order_detail_quantity}}</td>
                                    <td>{{number_format($sub_total,0,',','.')}}₫</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="left">
                                       Phí vận chuyển:
                                    </td>
                                    <td colspan="1" align="left">
                                        Miễn phí giao hàng
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="left">
                                        Tổng tiền hàng:
                                    </td>
                                    <td colspan="1" align="left">
                                        {{number_format($order -> order_total,0,',','.')}}₫
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <p style="color:#rgb(102,102,102)">Mọi chi tiết xin liên hệ website tại : <a target="_blank"
                        href="">Shop</a>, hoặc liên hệ qua số hotline : 0917889558 hoặc 0943705326.Xin cảm ơn
                    quý khách đã đặt hàng shop chúng tôi.
                </p>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

</html>