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
