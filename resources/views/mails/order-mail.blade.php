<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <p>Hi {{$order->name}}</p>
    <p>Đơn đặt hàng của bạn đã được đặt thành công!</p><br>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->detailOrder as $item)
                <tr>
                    <td>
                        <img src="{{asset('assets/imgs/products')}}/{{$item->product->image}}" width="100px" alt="">
                    </td>
                    <td>{{$item->product->name}}</td>
                    <td>{{$item->count}}</td>
                    <td>{{$item->price * $item->count}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td>{{$order->total}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>