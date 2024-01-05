<?php
require './CartDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "ALL ORDERS", $buffer);
echo $buffer;

$cartDatabase = new CartDatabase();
$result = $cartDatabase->getAllFromCart();

?>
<main>
    <div class="container">
        <div class="row cart-legend">
            <div class="col-md-4 text-center">
                <h4>ORDER</h4>
            </div>
            <div class="col-md-4">
                <h4>NUMBER OF ITEMS IN ORDER</h4>
            </div>
            <div class="col-md-4 text-center">
                <h4>ORDER DETAIL</h4>
            </div>
        </div>
        <?php foreach($result as $order):?>
        <?php $counter = 1;?>
        <div class="row item">
            <div class="col-md-4 text-center">
                <h4><?php echo $counter ?></h4>
            </div>
            <div class="col-md-4 text-center">
                <h4><?php echo $order['COUNT(`quantity`)'] ?></h4>
            </div>
            <div class="col-md-4 text-center">
                <a href="./order_details.php?order_id=<?php echo $order['order_id']?>"><i class="fa-solid fa-circle-info" style="color: #0a090d;"></i></a>
            </div>
        </div>
        <?php $counter++;?>
        <?php endforeach; ?>
    </div>
</main>
<?php include './footer.php'; ?>