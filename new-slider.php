
<?php
try{
if(isset($_POST['new'])){

if(file_exists($_FILES['file']['tmp_name'])){
$path1 = 'uploads/'.time();
$path1 .= $_FILES['file']['name'];
if(!is_dir('uploads')){
mkdir('uploads');
}
if(move_uploaded_file($_FILES['file']['tmp_name'], $path1)){      
$file =  $path1;
}else{      
}
}

$insertdb = $conn->prepare("INSERT INTO `sliders` (image_path) values (:image_path)");
$insertdb->execute([
'image_path' => $file,
]);

echo "<div class='alert alert-success'>";
echo "<strong>موفق</strong> ثبت انجام شد!";
echo "</div>";

}
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<form action="" method="post"  enctype="multipart/form-data">
<input type="file" class="form-control mt-2" name="file">
<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره پست</button>
</form>
