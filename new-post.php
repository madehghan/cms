<?php include 'modules/new-post.php' ?>


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

$title = $_POST['title'];
$content = $_POST['content'];
$type = $_POST['type'];
$category = $_POST['category'];
$insertdb = $conn->prepare("INSERT INTO `posts` (title,content,type,file,category) values (:title,:content,:type,:file,:category)");
$insertdb->execute([
'title' => $title,
'content' => $content,
'type' => '2',
'file' => $file,
'category' => $category,
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
<input type="" name="title" class="form-control mt-2" placeholder="تیتر مطلب">
<textarea  class="form-control mt-2" name="content"></textarea>
<input type="file" class="form-control mt-2" name="file">

<select class="form-control mt-2" name="category">
<option value="0">انتخاب نوع پست</option>
<option value="1">اخبار مجموعه</option>
<option value="2">مطالب صفحه اصلی</option>
</select>

<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره اطلاعات</button>
</form>
