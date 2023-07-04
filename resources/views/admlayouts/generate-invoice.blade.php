<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }

        .invoice-items {
            font-size: 14px;
            border-top: 1px dashed #ddd;
        }

        .invoice-items td {
            padding: 14px 0;

        }
        .table-info td {
            padding: 3px 6px;
        }
    </style>
</head>

<body>
    <section class="main-pd-wrapper" style="width: 450px; margin: auto">
        <div
            style="
                  text-align: center;
                  margin: auto;
                  line-height: 1.5;
                  font-size: 14px;
                  color: #4a4a4a;
                ">
            <h1 style="padding-left: 5px; font-size: 28px;">KidsLand</h1>

            <p style="font-weight: bold; margin-top: 10px; font-size: 18px;">
                HOA DON
            </p>
                <table style="margin-top: 10px" class="table-info">
                    <tr>
                        <td>Xin chao,</td>
                        <td style="width: 110px"></td>
                        <td><b>DN:</b> 0101234567</td>
                    </tr>
                    <tr>
                        <td>{{Str::slug($order->name, ' ')}}</td>
                        <td></td>
                        <td><b>VAT:</b> 0123456789</td>
                    </tr>
                    <tr>
                        <td>No.000{{$order->id}}</td>
                        <td></td>
                        <td><b>Date:</b> {{$order->updated_at}}</td>
                    </tr>
                </table>
            <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
        </div>
        <table style="width: 100%; table-layout: fixed">
            <thead>
                <tr>
                    <th style="width: 50px; padding-left: 0;">Sn.</th>
                    <th style="width: 220px;">San pham</th>
                    <th>qty</th>
                    <th style="text-align: right; padding-right: 0;">Gia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->detailOrder as $key => $item)
                    <tr class="invoice-items">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ Str::slug($item->product->name, ' ') }}</td>
                        <td>{{ $item->count }}</td>
                        <td style="text-align: right;">{{ number_format($item->price, 0) }} vnd</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%;
              background: #fcbd024f;
              border-radius: 4px;">
            <thead>
                <tr>
                    <th>Tong tien</th>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">{{ number_format($order->total, 0) }} vnd</th>

                </tr>
            </thead>

        </table>

        <table
            style="width: 100%;
              margin-top: 15px;
              border: 1px dashed #00cd00;
              border-radius: 3px;">
            <thead>
                <tr>
                    <td>Giam gia: </td>
                    <td style="text-align: right;">{{number_format($order->discount, 0)}} vnd</td>
                </tr>
                <tr>
                    <td>Thue gia tri gia tang: </td>
                    <td style="text-align: right;">10%</td>
                </tr>
            </thead>

        </table>
        <p
            style="font-size: 12px; padding-top: 10px; color: #5b5b5b; line-height: 18px; vertical-align: top; text-align: left;">
            Chuc ban mot ngay tot lanh.</p>
    </section>
</body>

</html>
