<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 8 PDF</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @page {
            margin: 1cm;
        }
    </style>
</head>
<body>
    <div class="container mt-4">        
                <div class="row">
                    <div class="col-md-8">
                        Cliente: {{ $cliente }}
                    </div>
                </div>
                <br><br><br><br><br>
                <div class="row">
                    <div class="col-md-12">        
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Impuesto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $cantidad_producto = 0;
                                        $precio_total_producto = 0;
                                        $impuesto_total_producto = 0;  
                                    ?>
                                    @foreach ($productos as $in)                 
                                        <?php 
                                            $cantidad_producto = $cantidad_producto + $in['cantidad_producto'];
                                            $precio_total_producto = $precio_total_producto + $in['precio_total_producto'];
                                            $impuesto_total_producto = $impuesto_total_producto + $in['impuesto_total_producto'];  
                                        ?>                                    
                                        <tr>
                                            <th>{{ $in['name'] }}</th>
                                            <th>{{ $in['cantidad_producto'] }}</th>
                                            <td>{{ number_format($in['precio_total_producto'], 2, ',', '.') }}$</td>
                                            <td>{{ number_format($in['impuesto'], 2, ',', '.')  }}%</td>
                                        </tr>                 							
                                    @endforeach	 
                                </tbody>
                            </table>  
                    </div>
                    <div class="col-md-12">                       
                            <table class="table">
                                    <tr>
                                        <td>monto total</td>
                                        <td>{{ number_format($precio_total_producto, 2, ',', '.') }}$</td>
                                    </tr>
                                    <tr>
                                        <td>impuesto total</td>
                                        <td>{{ number_format($impuesto_total_producto, 2, ',', '.') }}%</td>
                                    </tr>                 							
                            </table>  
                    </div>                    
                </div>
                           
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>