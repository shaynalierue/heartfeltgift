<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style type="text/css" >
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_deg{
            border: 2px solid green;
        }

        th{
            background-color: skyblue;
            color:white;
            font-size: 19px;
            font-weight: bold;
            padding: 15px;
        }

        td{
            border: 1px solid skyblue;
            text-align: center;
            color:white;
        }

        input[type="search"]{
            width: 500px;
            height: 45px;
            margin-left: 50px;
            margin-right: 5px;
        }

        .form_deg{
            display: flex;
            align-items: center;
            justify-content:center;
        }

    </style>
    
  </head>
  <body>
    <!-- Header -->
    @include('admin.header')
    <!-- End of Header -->

   
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <form class="form_deg" action="{{url('product_search')}}" method="get">
                @csrf
                <input type="search" value="">
                <input type="submit" class="btn btn-secondary" value="Search">
            </form>



            <div class="div_deg">
                <table class="table_deg" class="table table-bordered table-hover" >
                    <tr>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>

                    @foreach($product as $products)
                    <tr>
                        <td>{{$products->title}}</td>
                        <td>{!! Str::limit($products->description, 50) !!}</td>
                        <td>{{$products->category}}</td>
                        <td>{{$products->price}}</td>
                        <td>{{$products->quantity}}</td>
                        <td>
                            <img height="120" width="120" src="{{ asset('products/'.$products->image) }}" alt="" srcset="">
                        </td>

                        <td>
                            <a class="btn btn-success" href="{{url('update_product', $products->id)}}">Edit</a>
                        </td>

                        <td>
                            <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_product', $products->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="div_deg" >
                {{ $product->onEachSide(1)->links() }}
            </div>

        </div>
      </div>
    </div>

    <!-- JavaScript files-->
    @include('admin.js')
  </body>
</html>