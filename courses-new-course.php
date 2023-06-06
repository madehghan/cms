
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
$description = $_POST['content'];
$teacher_id = $_POST['teacher_id'];
$price = $_POST['price'];
$exam_link = $_POST['exam_link'];
$insertdb = $conn->prepare("INSERT INTO `courses` (title,content,image,teacher_id,price,exam_link) values (:title,:content,:image,:teacher_id,:price,:exam_link)");
$insertdb->execute([
'title' => $title,
'content' => $content,
'image' => $file,
'teacher_id' => $teacher_id,
'price' => $price,
'exam_link' => $exam_link,
]);

echo "<div class='alert alert-success'>";
echo "<strong>موفق</strong> ثبت انجام شد!";
echo "</div>";

}
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<?php include 'modules/new-course.php' ?>
<form action="" method="post"  enctype="multipart/form-data">
<input type="" name="title" class="form-control mt-2" placeholder="نام دوره">
<input type="number" name="price" class="form-control mt-2" placeholder="قیمت دوره به تومان">
<textarea  class="form-control mt-2" name="content"></textarea>
<input type="file" class="form-control mt-2" name="file">
<select class="form-control mt-2" name="teacher_id">
<option value="0">انتخاب استاد...</option>
<?php
try{
$readdb = $conn->query("select * from users where role=3");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<option value="<?php echo $information->id ?>"><?php echo $information->name ?></option>
<?php endforeach; ?>
</select>
<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره اطلاعات</button>
</form>
