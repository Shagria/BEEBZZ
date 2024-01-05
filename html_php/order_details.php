<?php
require './CartDatabase.php';
require './ProductsDatabase.php';
require './UsersDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "ORDER DETAILS", $buffer);
echo $buffer;

$cartDatabase = new CartDatabase();
$usersDatabase = new UsersDatabase();
$adressesDatabase = new AdressesDatabase();
$productsDatabase = new ProductsDatabase();
if( isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $orders = $cartDatabase->getCartByOrderId($order_id);
}
$total_quantity = 0;
foreach($orders as $order){
    $user_id = $order['user_id'];
    $total_quantity = $total_quantity + $order['quantity'];
    $date = date('m/d/Y', $order['order_id']);
}
$total_price = 0;
?>
<main>
    <div class="container">
        <!--USER INFO-->
        <?php
         $users = $usersDatabase->getUserById($user_id);
         foreach($users as $user):
         
         ?>
        <div class="row" style="margin-top: 10px;">
            <h3>Ordered: <?php echo $date?></h3>
        </div>
        <hr>
        <div class="row">
            <h4><?php echo $user['first_name'] . " " . $user['second_name']?></h4>
        </div>
        <div class="row">
            <h4>Email: <?php echo $user['email']?> Phone: <?php echo $user['phone']?></h4>
        </div>
        <?php
        $adresses = $adressesDatabase->fetchById($user['adress_id']);
        foreach($adresses as $adress):
        ?>
        <div class="row">
            <p>Country: <?php echo $adress['country'];?></p>
        </div>
        <div class="row">
            <p>City: <?php echo $adress['city'];?></p>
        </div>
        <div class="row">
            <p>Street: <?php echo $adress['street_plus_number'];?></p>
        </div>
        <div class="row">
            <p>Postal: <?php echo $adress['postal_code'];?></p>
        </div>
         <?php endforeach;?>
         <?php endforeach;?>
        <!--PRODUCTS-->
        <hr>
        <div class="row cart-legend">
            <div class="col-md-3 text-center">
                <h4>PRODUCT ID</h4>
            </div>
            <div class="col-md-3 text-center">
                <h4>PRODUCT NAME</h4>
            </div>
            <div class="col-md-3 text-center">
                <h4>PRICE PER PIECE</h4>
            </div>
            <div class="col-md-3 text-center">
                <h4>QUANTITY</h4>
            </div>
        </div>
        <?php 
        foreach($orders as $order):
        $products = $productsDatabase->fetchByProductId($order['product_id']);
        foreach($products as $product):
            $total_price = $total_price + ($product['price'] * $order['quantity']);
        ?>
        <div class="row item">
            <div class="col-md-3 text-center">
                <h5><?php echo $product['product_id']?></h5>
            </div>
            <div class="col-md-3 text-center">
                <h5><?php echo $product['name']?></h5>
            </div>
            <div class="col-md-3 text-center">
                <h5><?php echo $product['price']?></h5>
            </div>
            <div class="col-md-3 text-center">
                <h5><?php echo $order['quantity']?></h5>
            </div>
        </div>
        <?php endforeach;?>
        <?php endforeach;?>
        <div class="row item" style="background-color:black; color: white;">
            <div class="col-md-4"><h5>TOTAL:</h5></div>
            <div class="col-md-4"><h5>Price:  <?php echo $total_price ?></h5></div>
            <div class="col-md-4"><h5>Quantity:  <?php echo $total_quantity ?></h5></div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>