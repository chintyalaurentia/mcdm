<?php 
include "include/connect.php";
include 'linksBootstrap.php';
include 'naive_bayes.php';

$result = [];
if(isset($_POST['submit'])){
    $data = [
        "sales_in_thousands" => $_POST['sales'],
        "year_resale_value" => $_POST['year'],
        "price_in_thousands" => $_POST['price'],
        "horsepower" => $_POST['horsepower'],
        "curb_weight" => $_POST['curb'],
        "fuel_capacity" => $_POST['fuelc'],
        "fuel_efficiency" => $_POST['fuele'],
        
    ];
    $result = posteriorProbability($data);
}

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
            font-weight: 700;
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
            /* box-shadow:inset 0px 39px 0px -24px white; */
            transition: ease-in-out 0.5s; 

        }

        #calc:hover{
            /* transition-duration: 2s; */
            transform: scale(1.05);
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
            font-size: 30px;
            font-weight: 900;
        }

        h1 {
            color: #1e1e71;
            font-weight: 900;
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

        .rank-wrapper {

            background: rgba(255, 255, 255, 0.23);
            border-radius: 7px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2.6px);
            -webkit-backdrop-filter: blur(2.6px);
            border: 1px solid rgba(255, 255, 255, 0.62);
            color: #1e1e71;
        }

        .rank-urut {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .num-rank {
            background: rgba(255, 255, 255, 0.57);
            border-radius: 560px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2.6px);
            -webkit-backdrop-filter: blur(2.6px);
            border: 1px solid rgba(255, 255, 255, 0.62);
            color: #1e1e71;
            width:20%;
        }

        .car-brand {
            font-weight: 700;
        }

        .form-select:focus, .form-control:focus, .btn:focus, .btn-primary:focus, .btn:focus-visible, .btn-primary:active:focus {
            border-color: transparent;
            outline: 0;
            box-shadow: 0 0 0 0rem rgba(13,110,253,0);
        }

        thead, th {
            /* background-color: #1e1e71; */
            background: linear-gradient(to right,#1e1e71 ,#8B75C1);

            color: white;
        }

        tbody, td, tfoot, th, thead, tr {
            border-bottom: solid 2px white;
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
    <div class="container mt-4">
        <form action="" method="post">
            <div class="row mt-3 mb-3 pt-3 pb-3 design">
                <div class="col-md-12 text-center">
                    <h1>Naive Bayes 🧮</h1>
                </div>
                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Sales in Thousands</label>
                    <select class="form-select" id="sales" name="sales">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT sales_in_thousands FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['sales_in_thousands']; ?>"><?php echo $rowDist['sales_in_thousands']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>
            
                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Year Resale Value</label>
                    <select class="form-select" id="year" name="year">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT year_resale_value FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['year_resale_value']; ?>"><?php echo $rowDist['year_resale_value']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>

                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Price in Thousands</label>
                    <select class="form-select" id="price" name="price">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT price_in_thousands FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['price_in_thousands']; ?>"><?php echo $rowDist['price_in_thousands']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>

                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Horsepower</label>
                    <select class="form-select" id="horsepower" name="horsepower">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT horsepower FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['horsepower']; ?>"><?php echo $rowDist['horsepower']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>

                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Curb Weight</label>
                    <select class="form-select" id="curb" name="curb">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT curb_weight FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['curb_weight']; ?>"><?php echo $rowDist['curb_weight']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>

                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Fuel Capacity</label>
                    <select class="form-select" id="fuelc" name="fuelc">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT fuel_capacity FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['fuel_capacity']; ?>"><?php echo $rowDist['fuel_capacity']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>

                <div class="col-md-6 col-sm-12">
                <div class="input-group mb-3 my-3">
                    <label class="input-group-text" for="inputGroupSelect01">Fuel Efficiency</label>
                    <select class="form-select" id="fuele" name="fuele">
                    <option selected>Select Criteria</option>
                    <?php 
                    $queryDist = mysqli_query($conn,"SELECT DISTINCT fuel_efficiency FROM cars");
                    $no = 1;
                    while($rowDist = mysqli_fetch_assoc($queryDist))
                    { ?>
                        <option value="<?php echo $rowDist['fuel_efficiency']; ?>"><?php echo $rowDist['fuel_efficiency']; ?></option>   
                    <?php } ?>
                        </select>
                </div>
                </div>

                <div class="col-md-6 ds-sm-none last">
                    
                </div>

                <div class="col-md-12 text-center">
                    <button type="submit" name="submit" class="btn btn-primary" id="calc">Calculate</button>
                </div>
                <div class="col-md-12">
                    <label for="result" class="col-form-label text-center title">Result</label>
                    <!-- <input type="text" id="result" class="form-control" aria-labelledby="passwordHelpInline"> -->
                    <span id="result" class="form-text">
                        
                    </span>
                </div>

                <?php $i = 1;?>
                <?php foreach($result as $key => $val): ?>
                <div class="col-md-4 text-center p-3">
                    <div class="rank-wrapper">
                        
                        <?php if ($i==1){
                            echo "<h1 class='mt-5 text-center'>🥇</h1>";
                        } elseif($i==2){
                            echo "<h1 class='mt-5 text-center'>🥈</h1>";
                        } elseif($i==3){
                            echo  "<h1 class='mt-5 text-center'>🥉</h1>";
                        }?>

                        <!-- <h1 class="mt-5 text-center rank-urut"><div class="num-rank"><?= $i++ ?></div></h1> -->
                        
                        <div class="rank"><h3 class="car-brand"><?= $key ?></h3></div>
                        <div class="rank mb-4"> <?= $val ?></div>

                        
                    </div>
                </div>
                <?php endforeach; ?>

                <!-- <div class="col-md-4 text-center">
                    <div class="rank-wrapper">
                        <h3>2</h3>
                        <div class="rank"></div>
                    </div>
                </div>

                <div class="col-md-4 text-center">
                    <div class="rank-wrapper">
                        <h3>3</h3>
                        <div class="rank"></div>
                    </div>
                </div> -->
            </div>
        </form>

       

        

    </div>

   

</body>

<script>
        $(document).ready(function() {
            // $('#data-table').DataTable( {
            //     "ordering": false
            // } );

            // $('#result').html('<?php var_dump($result); ?>');


        })
    </script>
</html>