

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" href="style.css">
</head>

<?php

session_start();

require_once ('php/CreateDb.php');
require_once ('./php/component.php');


// create instance of Createdb class
$database = new CreateDb("Productdb", "Producttb");

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");
      
        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'qty'=> $_POST['qty']

            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{
        $item_array = array(
                'product_id' => $_POST['product_id'],
                'qty'=> $_POST['qty']
        );
        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        // print_r($_SESSION['cart']);
    }
}


?>
<body>


<?php require_once ("php/header.php") ; ?>
<div class="container">
        <div class="row text-center py-5">
        <div class="col-md-8 listing-page">
        <table class="listing-table">
            <thead>
                <tr>
                <th>PRODUCT</th>
                <th>SKU</th>
                <th>PRICE</th>
                <th>ACTION</th>
                </tr>
            </thead>
            <tbody class="listing-item">                        
            <?php
                $con=mysqli_connect('localhost','root','','productdb');
                mysqli_select_db($con,'productdb');
                


                $results_per_page= 8;

                $sql = "SELECT * FROM producttb";
                $result = mysqli_query($con, $sql);                 
                $number_of_results=mysqli_num_rows($result);

                // while ($row = mysqli_fetch_assoc($result)){
                //     component($row['product_name'], $row['product_price'], $row['product_image'],$row['product_sku'], $row['id']);
                // }   
                
                $number_of_pages= ceil($number_of_results/$results_per_page);

                 //determine which page number visitor is currently on                
                 if(!isset($_GET['page'])) {
                    $page=1;
                }
                else {
                    $page=$_GET['page'];
                }

                //determine the sql limit starting number for the results on the displaying page
                $this_page_first_result=($page-1) * $results_per_page;

                //retrieve selected results from database and display them on page
                $sql = "SELECT * FROM producttb  LIMIT $this_page_first_result , $results_per_page ";
                $result=mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                    component($row['product_name'], $row['product_price'], $row['product_image'],$row['product_sku'], $row['id']);
                }   
                echo "pagination:";
                for($page=1;$page<=$number_of_pages;$page++) {
                    echo '<a href="/phpTraining/Assessment/Shopping_Cart/index.php?page=' .$page. '"><button class="btn btn-success m-2">'.$page. '</button></a>';
                }
  
            ?>
            </tbody>
        </table>
        </div>
        </div>
</div>




<!-- jqury CDN -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
