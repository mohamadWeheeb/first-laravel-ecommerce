<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Product Price</th>
        </tr>
        @foreach($products as $product)
        <td>
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->image_url }}</td>
                <td>{{ $product->price }}</td>
            </tr>
        </td>
        @endforeach
    </table>
</body>
</html>
