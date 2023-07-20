
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


<img src="<?php echo $my_profile_avatar ?>"  width="50px" height="50px" class="img-circle">

<input type="file" name="avatar" id="file" class="inputfile">
<br>
</label>
</center>



    <button type="submit" name="update_avatar" class="btn btn-warning w-100 mb-2 mt-2">به روزرسانی تصویر پروفایل</button>



</form>
