<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{$data->product->product_title}}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            line-height: 24px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.85em;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th {
            background: #f9f9f9;
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    <div class="header">
        <div>
            <h1 style="margin:0;">INVOICE</h1>
        </div>
        <div style="text-align: right;">
            <strong>Order Date:</strong> {{ date('Y-m-d') }}
        </div>
    </div>

    <div class="info-section">
        <div>
            <div class="section-title">Bill To:</div>
            <strong>{{$data->user->name}}</strong><br>
            {{$data->reciever_address}}<br>
            Phone: {{$data->reciever_phone}}
        </div>
        <div style="text-align: right;">
            <div class="section-title">Store Info:</div>
            <strong>Laravel E-Commerce</strong><br>
            support@laravelecommerce.com<br>
            www.laravel-e-commerce.com
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>Product Description</th>
            <th style="text-align: right;">Amount</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$data->product->product_title}}</td>
            <td style="text-align: right;">${{ number_format($data->product->product_price, 2) }}</td>
        </tr>
        </tbody>
    </table>

    <div class="total">
        Total: ${{ number_format($data->product->product_price, 2) }}
    </div>

    <div style="margin-top: 50px; font-size: 0.8em; color: #999; text-align: center;">
        Thank you for your purchase! If you have any questions, contact us anytime.
    </div>
</div>

</body>
</html>
