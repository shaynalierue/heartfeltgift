<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')

    <style>
        table{
            border: 2px solid skyblue;
            text-align: center;
            
        }

        th{
            
            padding: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
            background-color: skyblue;

        }

        td{
          color: white;
          padding: 10px;
          border: 1px solid skyblue;
        }

        .table_center{
            display:flex;
            justify-content: center;
            align-items: center;
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

          <div class="table_center" >
            <table>
                    <tr>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Product Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Change Status Order</th>
                        <th>Print</th>
                    </tr>

                    @foreach($data as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td>{{$data->rec_address}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->product->title}}</td>
                        <td>{{$data->product->price}}</td>
                        <td>
                          <img width="150" src="products/{{$data->product->image}}" alt="">
                        </td>
                        <td style="color:
                          @if($data->status == 'Delivered')
                              pink
                          @elseif($data->status == 'On the way')
                              yellow
                          @else
                              red
                          @endif;                          
                          font-weight: bold;
                          
                          ">
                          {{$data->status}}
                      </td>
                      <td class="action-buttons">
                        <a class="btn btn-primary" href="{{url('on_the_way', $data->id)}}">On the way</a>
                        <a class="btn btn-success" href="{{url('delivered', $data->id)}}">Delivered</a>
                      </td>
                      <td>
                        <a class="btn btn-secondary" href="{{url('print_pdf', $data->id)}}">Print PDF</a>
                      </td>
                    </tr>
                    @endforeach
                </table>
          </div>
            
            
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>