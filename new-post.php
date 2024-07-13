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
$insertdb = $conn->prepare("INSERT INTO `posts` (title,content,file) values (:title,:content,:file)");
$insertdb->execute([
'title' => $title,
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
<input type="" name="title" class="form-control mt-2" placeholder="تیتر مطلب">
<textarea  class="form-control mt-2" name="content" style="height:300px;"></textarea>
<input type="file" class="form-control mt-2" name="file">
<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره پست</button>
</form>

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    content TEXT CHARACTER SET utf8 COLLATE utf8_general_ci,
    file VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
);

