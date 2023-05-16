<?php include 'modules/new-product.php' ?>


<?php
try{
if(isset($_POST['new'])){

if(file_exists($_FILES['image']['tmp_name'])){
$path1 = 'uploads/'.time();
$path1 .= $_FILES['image']['name'];
if(!is_dir('uploads')){
mkdir('uploads');
}
if(move_uploaded_file($_FILES['image']['tmp_name'], $path1)){      
$file =  $path1;
}else{      
}
}

if(file_exists($_FILES['file']['tmp_name'])){
$path1 = 'uploads/'.time();
$path1 .= $_FILES['file']['name'];
if(!is_dir('uploads')){
mkdir('uploads');
}
if(move_uploaded_file($_FILES['file']['tmp_name'], $path1)){      
$file2 =  $path1;
}else{      
}
}

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$price_off = $_POST['price_off'];
$insertdb = $conn->prepare("INSERT INTO `products` (title,description,price,image,file,price_off) values (:title,:description,:price,:image,:file,:price_off)");
$insertdb->execute([
'title' => $title,
'description' => $description,
'image' => $file,
'price' => $price,
'file' => $file2,
'price_off' => $price_off,
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
<input type="" name="title" class="form-control mt-2" placeholder="نام محصول">
<input type="number" name="price" class="form-control mt-2 mb-2" placeholder="قیمت محصول به تومان">
<input type="number" name="price_off" class="form-control mt-2 mb-2" placeholder="درصد تخفیف">
<textarea  class="form-control mt-2" name="description"></textarea>
<input type="file" class="form-control mt-2" name="image">
<label class="mt-2">انتخاب فایل</label>
<input type="file" class="form-control mt-2" name="file">
<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره اطلاعات</button>
</form>
