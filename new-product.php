
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

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$numbers = $_POST['numbers'];
$insertdb = $conn->prepare("INSERT INTO `products` (title,description,price,image,numbers) values (:title,:description,:price,:image,:numbers)");
$insertdb->execute([
'title' => $title,
'description' => $description,
'image' => $file,
'price' => $price,
'numbers' => $numbers,
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
<input type="number" name="numbers" class="form-control mt-2 mb-2" placeholder="تعداد محصول">
<textarea  class="form-control mt-2" name="description" placeholder="توضیحات محصول"></textarea>
<label class="mt-2">انتخاب تصویر</label>
<input type="file" class="form-control mt-2" name="image">
<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره اطلاعات</button>
</form>
