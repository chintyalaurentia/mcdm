<?php 
include "include/connect.php";
include 'linksBootstrap.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Data Tables -->
     <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500;700;900&display=swap" rel="stylesheet">

     <!-- Font Awesome -->
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <title>Naive Bayes</title>

    <style>
        body {
            background-image: linear-gradient(to right top, #fbb75f, #ffb792, #ffc2c4, #ffd5ea, #ffe9fd, #f7e0fd, #ecd8fe, #ded1ff, #cbadff, #bb88fd, #ae5ef6, #a41fec);
            font-family: 'Nunito', sans-serif;
        }

        .last {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #calc {
            width: 50%;
            background: linear-gradient(to right,#1e1e71 ,#8B75C1);
            background-color: #1e1e71;
            color: white;
            font-weight: 700;
            border-radius: 10px;
            box-shadow:inset 0px 39px 0px -24px white;
            transition-duration: 0.5s;
            transition-timing-function: ease; 

        }
        #calc:hover{
            
            /* transform: scale(0.98); */
        }

        .design {
            background: rgba(255, 255, 255, 0.22);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.1px);
            -webkit-backdrop-filter: blur(5.1px);
            border: 1px solid rgba(255, 255, 255, 0.62);
        }

        .design-navbar {
            background: rgba(255, 255, 255, 0.70);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5.1px);
            -webkit-backdrop-filter: blur(5.1px);
            border: 1px solid rgba(255, 255, 255, 0.62);
        }

        .navbar-title {
            color: #1e1e71;
            font-weight: 900;
        }

        .nav-item, .navbar-nav .nav-link.active{
            color: #1e1e71;
            font-weight: 700;
        }

        .title {
            color: #1e1e71;
            font-size: 20px;
            font-weight: 900;
        }

        h1 {
            color: #1e1e71;
            font-weight: 900;
        }

        .row {
            margin-top: 3%;
        }

        .input-group-text {
            width: 162px;
            background: rgb(177 184 242 / 60%);
            border-radius: 7px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(7.4px);
            -webkit-backdrop-filter: blur(7.4px);
            border: 1px solid rgba(255, 255, 255, 0.62);
            font-weight: 700;
            color: #1e1e71;
        }

        .form-select {
            background-color: rgba(255, 255, 255, 0.30);
            border-radius: 7px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2.6px);
            -webkit-backdrop-filter: blur(2.6px);
            border: 1px solid rgba(255, 255, 255, 0.62);
            color: #1e1e71;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.53);
            border-radius: 7px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2.6px);
            -webkit-backdrop-filter: blur(2.6px);
            border: 1px solid rgba(255, 255, 255, 0.62);
            color: #1e1e71;
        }

        .form-select:focus, .form-control:focus, .btn:focus, .btn-primary:focus, .btn:focus-visible, .btn-primary:active:focus {
            border-color: transparent;
            outline: 0;
            box-shadow: 0 0 0 0rem rgba(13,110,253,0);
        }

        thead {
            /* background-color: #1e1e71; */
            background: linear-gradient(to right,#1e1e71 ,#8B75C1);

            color: white;
        }

        tbody, td, tfoot, th, thead, tr {
            border-bottom: solid 2px white;
        }

        .paginate_button .page-item {
           background-color:linear-gradient(to right,#1e1e71 ,#8B75C1);

        }

        .car {
            animation: linear infinite alternate;
            animation-name: run;
            animation-duration: 7s;
            width: 100px;
            font-size: 20px;
        }

        @-webkit-keyframes run {
          0% {
            left: 0;
          }
          48% {
            -webkit-transform: rotateY(0deg); 
          }
          50% { 
            left: 30px;
            -webkit-transform: rotateY(180deg); 
          }
          98% {
            -webkit-transform: rotateY(180deg); 
          }
          100% {
            left: 0;    
             -webkit-transform: rotateY(0deg);
          }
        }

        @media screen and (max-width: 991px) {
            .table_wrapper {
                overflow-x: auto;
            }
        }

    </style>
</head>
<body>
    <?php include "include/navbar.php"; ?>
    <div class="container">

        
        <div class="table_wrapper design p-3 mt-5 mb-5">
            <h1 class="text-center">Car Sales 📊</h1>

            <table class="table table-responsive table-hover text-center mt-2" id="data-table">
            <thead >
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Manufacturer</th>
                    <th scope="col">Sales in <br> Thousands</th>
                    <th scope="col">Year Resale <br> Value</th>
                    <th scope="col">Price in <br> Thousands</th>
                    <th scope="col">Horsepower</th>
                    <th scope="col">Curb <br> Weight</th>
                    <th scope="col">Fuel <br> Capacity</th>
                    <th scope="col">Fuel <br> Efficiency</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = mysqli_query($conn,"SELECT * FROM cars");
                $no = 1;
                while($row = mysqli_fetch_array($query))
                { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['manufacturer']; ?></td>
                        <td><?php echo $row['sales_in_thousands']; ?></td>
                        <td><?php echo $row['year_resale_value']; ?></td>
                        <td><?php echo $row['price_in_thousands']; ?></td>
                        <td><?php echo $row['horsepower']; ?></td>
                        <td><?php echo $row['curb_weight']; ?></td>
                        <td><?php echo $row['fuel_capacity']; ?></td>
                        <td><?php echo $row['fuel_efficiency']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>
                
        </div>
    </div>

   

</body>

<script>
        $(document).ready(function() {
            $('#data-table').DataTable( {
                "ordering": false
            } );
        })
    </script>
</html>