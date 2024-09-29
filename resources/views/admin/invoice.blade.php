<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

    <center>
        <h1>- Product Invoice -</h1>
    </center>
    

    <h1>Customer Details</h1>
   
        <h3>Customer name : {{$data->name}}</h3>
        <h3>Customer address : {{$data->rec_address}}</h3>
        <h3>Customer phone : {{$data->phone}}</h3>
    

    <h1>Product Details</h1>
    
        <h2>Product title : {{$data->product->title}}</h2>
        <h2>Product price : {{$data->product->price}}</h2>
        <!-- <img src="products/{{$data->product->image}}" alt=""> -->
        <!-- <img src="{{ public_path('products/'.$data->product->image) }}" alt=""> -->

</body>
</html>