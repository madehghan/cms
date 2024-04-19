
    <form action="search" method="POST">
        <input class="form-control" name="search" placeholder="جستجو">
    </form>
    
<?php 
if(isset($_POST['search'])) {
    $get_title = $_POST['search'];
    try {
        $stmt = $conn->prepare("SELECT * FROM products WHERE title LIKE ?");
        $stmt->execute(array("%$get_title%"));
        $read_db = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch(Exception $e) {
        echo $e->getMessage();
    }
    if(!empty($read_db)) {
?>
    <div class="row mt-4">
        <?php foreach($read_db as $information) :?>
        <div class="col-6 text-center mb-3">
            <a href="product.php?id=<?php echo $information->id ?>"> 
                <img src="../<?php echo $information->image ?>" class="w-75">
                <div class="cat-list-2c-title"><?php echo $information->title ?></div>
                <div class="cat-list-2c-price"><?php echo number_format($information->price) ?> تومان</div>
            </a> 
        </div>
        <?php endforeach; ?>
    </div>
<?php
    } else {
        echo "موردی یافت نشد.";
    }
}
?>
