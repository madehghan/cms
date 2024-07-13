
<?php
$getid=$_GET['id'];
try{
$readdb = $conn->query("select * from users where id=$getid");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information_user) :?>
<div class="row">
    <div class="col-sm-4">
        <div class="card border rounded p-4 m-3">
            <h5>اطلاعات کاربری</h5>
            <hr>
            شماره موبایل: <?php echo $information_user->phone_number ?>
            <hr>
            نام  و نام خانوادگی: <?php echo $information_user->name ? $information_user->name : "بدون نام"; ?>
            <hr>
            سطح کاربری:
            <?php
            echo ($information_user->role == 1) ? "ادمین" : (($information_user->role == 2) ? "کاربر" : "");
            ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border rounded p-4 m-3">
            <h5>باکس</h5>
            <hr>
            <?php include 'modules' ?>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border rounded p-4 m-3">
            <h5>باکس</h5>
            <hr>
            <?php include 'modules' ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

