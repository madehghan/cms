
<?php
try{
if(isset($_POST['update'])){
$name = $_POST['name'];
$phone_number = $_POST['phone_number'];
$adress = $_POST['adress'];
$users_up_get = $conn->prepare("UPDATE `users` SET 
`name` = :name ,
`phone_number` = :phone_number ,
`adress` = :adress 
WHERE id = $my_profile_id ");
$users_up_get->execute([
'name' => $name,
'phone_number' => $phone_number,
'adress' => $adress,
]);
$profile_errors[] = 'اطلاعات با موفقیت به روزرسانی شد';
echo "<meta http-equiv='refresh' content='0'>";
}
}catch(Exception $e){
echo  @$e->getMessage();
}
?>

<?php
try{
if(isset($_POST['update_password'])){
$static_password = md5($_POST['static_password']);
$users_up_get = $conn->prepare("UPDATE `users` SET 
`static_password` = :static_password 
WHERE id = $my_profile_id ");
$users_up_get->execute([
'static_password' => $static_password,
]);

echo "<div class='alert alert-success'>";
echo "<strong>موفقیت!</strong> اطلاعات با موفقیت ذخیره شد.";
echo "</div>";


}
}catch(Exception $e){
echo  @$e->getMessage();
}
?>

  
<div class="row mt-3">
    
    <div class="col-sm-6">
    <div class="m-3">تغییر اطلاعات پروفایل</div>
    <hr>
        <?php include 'modules/profile.php' ?>
        <form action="" method="POST">
            <input class="form-control mb-2" name="name" value="<?php echo $my_profile_name ?>" placeholder="نام و نام خانوادگی">
            <input class="form-control mb-2" name="phone_number" value="<?php echo $my_profile_phone_number ?>" placeholder="شماره تماس">
            <input class="form-control mb-2" name="adress" value="<?php echo $my_profile_adress ?>" placeholder="آدرس">
            <button type="submit" name="update" class="btn btn-primary w-100">به روز رسانی</button>
        </form>
    </div>
    
    
    <div class="col-sm-6">
    <div class="m-3">تغییر کلمه عبور</div>
    <hr>
        <?php include 'modules/resetpass.php' ?>
        <form action="" method="POST">
            <input class="form-control mb-2" name="static_password" placeholder="پسورد جدید خود را وارد نمایید">
            <button type="submit" name="update_password" class="btn btn-primary w-100">به روز رسانی کلمه عبور</button>
        </form>
    </div>
    
</div>
