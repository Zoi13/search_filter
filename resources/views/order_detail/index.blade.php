<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        h1 {
            text-align: center;
        }

        p {
            text-align: center;
        }

        div {
            text-align: center;
        }

        button {
            text-align: center;
        }

    </style>

</head>

<body>
    <div class="container-fluid">
        <h1>Bills</h1>
        <div class="card">
            <div class="card-header">
                <form class="row row-cols-lg-auto g-1">
                    <div class="col">
                        <select class="form-select" name="category_id">
                            <option value="">All Category</option>
                            @foreach($categories as $category)
                            @if($category_id==$category->category_id)
                            <option value="{{ $category->category_id }}" selected>{{ $category->category_name }}</option>
                            @else
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                            @endif
                            @endforeach
                        </select>
    
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="date" class="form-control" name="start" value="{{ $start }}" />
                            <input type="date" class="form-control" name="end" value="{{ $end }}" />
                        </div>
 
                    </div>


                    </div>

            </div>
            <div class="col">
                <input type="text" class="form-control" name="q" value="{{$q}}" placeholder="Seach here..." />
            </div>

            <div class="col">
            <style>
  #myButton {
   position: absolute;
   left: 50%;
   top: 50%;
   transform: translate(-50%, -50%);
   background-color: blue;
   color: white;
   padding: 10px 20px;
   border: none;
   cursor: pointer;
  }
 </style>
</head>
<body>
 <button id="myButton">Search Here</button>

 <script>
  var button = document.getElementById("myButton");

  document.addEventListener("mousemove", function(event) {
   var x = event.clientX;
   var y = event.clientY;
   var buttonX = button.getBoundingClientRect().left + (button.offsetWidth / 2);
   var buttonY = button.getBoundingClientRect().top + (button.offsetHeight / 2);
   var deltaX = x - buttonX;
   var deltaY = y - buttonY;
   var distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
   var maxDistance = 200;
   if (distance < maxDistance) {
    button.style.left = buttonX - deltaX * maxDistance / distance - button.offsetWidth / 2 + "px";
    button.style.top = buttonY - deltaY * maxDistance / distance - button.offsetHeight / 2 + "px";
   }

   // Check if the button is outside the visible screen area
   var rect = button.getBoundingClientRect();
   if (rect.left < 0) {
    button.style.left = "0";
   } else if (rect.right > window.innerWidth) {
    button.style.left = window.innerWidth - rect.width + "px";
   }
   if (rect.top < 0) {
    button.style.top = "0";
   } else if (rect.bottom > window.innerHeight) {
    button.style.top = window.innerHeight - rect.height + "px";
   }
  });
 </script>
            </div>

            </form>

        </div>
        <div class="card-body body p-0">
            <table class="table table-hover table-bordered table-striped table-sm m-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>OrderID</th>
                        <th>OrderDate</th>
                        <th>CustomerID</th>
                        <th>CustomerName</th>
                        <th>ProductID</th>
                        <th>ProductName</th>
                        <th>CategoryID</th>
                        <th>CategoryName</th>
                        <th>Quality</th>
                        <th>Price</th>
                        <th>Total</th>

                    </tr>

                </thead>
                <?php
                                $i = 1;
                                ?>
                @foreach($order_details as $order_detail)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $order_detail->order_id }}</td>
                    <td>{{ date('M d Y', strtotime($order_detail->order_date)) }}</td>
                    <td>{{ $order_detail->customer_id }}</td>
                    <td>{{ $order_detail->customer_name }}</td>
                    <td>{{ $order_detail->product_id }}</td>
                    <td>{{ $order_detail->product_name }}</td>
                    <td>{{ $order_detail->category_id }}</td>
                    <td>{{ $order_detail->category_name }}</td>
                    <td>{{ $order_detail->quantity }}</td>
                    <td>{{ number_format($order_detail->price, 2) }}</td>
                    <td>{{ number_format($order_detail->total, 2) }}</td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
    @if($order_details->hasPages())
    <div class="card-footer">
        {{$order_details->links()}}
    </div>
    @endif
    </div>
</body>

</html>
