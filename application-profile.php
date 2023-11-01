
<div class="container mt-2">


<style>
    .inputfile {
  /* visibility: hidden etc. wont work */
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile:focus + label {
  /* keyboard navigation */
  outline: 1px dotted #000;
  outline: -webkit-focus-ring-color auto 5px;
}
.inputfile + label * {
  pointer-events: none;
}
</style>

<?php
if (isset($_POST['update_avatar'])) {
    if (file_exists($_FILES['avatar']['tmp_name'])) {
        $path = 'uploads/' . time();
        $path .= $_FILES['avatar']['name'];
        if (!is_dir('uploads')) {
            mkdir('uploads');
        }
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $path)) {
            // Original uploaded image path
            $originalImage = $path;
            
            // Desired width and height of the cropped image
            $croppedSize = 200;

            // Load the original image
            $image = imagecreatefromjpeg($originalImage);
            $width = imagesx($image);
            $height = imagesy($image);

            // Calculate the coordinates for cropping
            $cropX = 0;
            $cropY = 0;
            $cropSize = min($width, $height);

            // Create a square cropped image
            $croppedImage = imagecreatetruecolor($croppedSize, $croppedSize);
            imagecopyresampled(
                $croppedImage,
                $image,
                0,
                0,
                $cropX,
                $cropY,
                $croppedSize,
                $croppedSize,
                $cropSize,
                $cropSize
            );

            // Save the cropped image
            $croppedPath = 'uploads/cropped_' . time() . $_FILES['avatar']['name'];
            imagejpeg($croppedImage, $croppedPath);

            // Update the avatar field in the database
            $id_profileme = $_POST['id_profile'];
            @$rejister_form = $conn->prepare("UPDATE `users` SET `avatar` = :avatar WHERE id = $id_profileme");
            @$rejister_form->execute(['avatar' => $croppedPath]);
            
            // Free up memory
            imagedestroy($image);
            imagedestroy($croppedImage);

            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            // File upload failed
        }
    } else {
        // No file uploaded
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
<center>

<input name="id_profile" value="<?php echo $my_profile_id ?>" style="display:none;" type="text" class="form-control" placeholder="">


<label for="file">


<img src="<?php echo $my_profile_avatar ?>"  width="200px" height="200px" style="border-radius:100%" class="img-circle">

<input type="file" name="avatar" id="file" class="inputfile">
<br>
</label>
</center>



    <button type="submit" name="update_avatar" class="btn btn-warning w-100 mb-2 mt-2">به روزرسانی تصویر پروفایل</button>



</form>

<hr>


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
    
    
    
</div>

</div>

