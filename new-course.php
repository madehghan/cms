
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

$price = $_POST['price'];
$content = $_POST['content'];
$title = $_POST['title'];
$insertdb = $conn->prepare("INSERT INTO `courses` (title,price,content,file) values (:title,:price,:content,:file)");
$insertdb->execute([
'title' => $title,
'price' => $price,
'content' => $content,
'file' => $file,
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
<input type="" name="title" class="form-control mt-2" placeholder="عنوان دوره">
<input type="number" name="price" class="form-control mt-2" placeholder="قیمت دوره">
<textarea  class="form-control mt-2" name="content" style="height:300px;" placeholder="توضیحات دوره"></textarea>
<input type="file" class="form-control mt-2" name="file">
<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">انتشار دوره</button>
</form>

CREATE TABLE `courses` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `price` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `file` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
