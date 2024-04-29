<?php include 'views/headin3.php' ?>

<h6>داشبورد</h6>
<hr>

<div class="row">
    <div class="col-sm">
            <div class="bg-primary rounded p-3 text-center text-light mb-3">
            <h6> <i class="bi bi-wallet2"></i> موجودی کیف پول</h6>
            <hr>
            <div class="">
            
            
            <?php
        try {
            // Assuming $conn is your PDO connection object
            $stmt = $conn->prepare("SELECT SUM(price) AS total_price FROM payments WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $my_profile_id);
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC);
            $total_price = $total['total_price'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        ?>
        <?php echo number_format($total_price) ?> 
         تومان </div>
        </div>
    </div>
    <div class="col-sm">
    
    
    
<h6>شارژ حساب کاربری</h6>


<?php

require 'modules/zibal-1-function.php';

if(isset($_POST['newpay'])){
$totalprice = $_POST['totalpricee'];
$description = $_POST['description'];
$location = $_POST['location'];
$type = $_POST['product_id'];

$parameters = array(
    "merchant"=> ZIBAL_MERCHANT_KEY,//required
    "callbackUrl"=> "https://mzaidbaz.ir/zibal-3-ok-check-pay.php?user_id=$my_profile_id&price=$totalprice",//required
    "amount"=> $totalprice,//required
    "description"=> $description,

    "orderId"=> time(),//optional
    "mobile"=> $my_profile_phone_number,//optional for mpg
);

$response = postToZibal('request', $parameters);
var_dump($response);
if ($response->result == 100)
{
    $startGateWayUrl = "https://gateway.zibal.ir/start/".$response->trackId;
    header('location: '.$startGateWayUrl);
}
else{
    echo "errorCode: ".$response->result."<br>";
    echo "message: ".$response->message;
}
}

?>


<form method="POST">
<input class="form-control" name="totalpricee" type="number" placeholder="مبلغ را به تومان وارد نمایید:">
<button type="submit" name="newpay" class="btn btn-success w-100 mt-2">ورود به درگاه پرداخت</button>
</form>




    </div>
</div>

<hr>
<?php
try{
$readdb = $conn->query("select * from payments where user_id=$my_profile_id order by id desc");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information_walltet_items) :?>
<div class="bg-light p-3 mb-1 color-dark rounded">
    <?php echo number_format($information_walltet_items->price) ?> تومان<span class="badge bg-warning text-dark rounded-pill" style="float:left"><?php echo $information_walltet_items->text ?></span>
    <hr>
    <?php echo $information_walltet_items->date ?> - <?php echo $information_walltet_items->time ?>
    </div>
<?php endforeach; ?>


<?php include 'views/footer2.php' ?>
