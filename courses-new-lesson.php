
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
$course_id = $_POST['course_id'];
$lok = $_POST['lok'];
$insertdb = $conn->prepare("INSERT INTO `lessons` (course_id,document,title,lok) values (:course_id,:document,:title,:lok)");
$insertdb->execute([
'course_id' => $course_id,
'document' => $file,
'title' => $title,
'lok' => $lok,
]);

echo "<div class='alert alert-success'>";
echo "<strong>موفق!</strong> ثبت شد!";
echo "</div>";

}
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<?php include 'modules/new-lesson.php' ?>
<form action="" method="post"  enctype="multipart/form-data">


<input type="" name="title" class="form-control mt-2" placeholder="تیتر درس">
<select class="form-control mt-2" name="course_id">
<option value="0">انتخاب دوره...</option>
<?php
try{
$readdb = $conn->query("select * from courses");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<option value="<?php echo $information->id ?>"><?php echo $information->title ?></option>
<?php endforeach; ?>
</select>

<label class="mt-3">انتخاب فایل</label>
<input type="file" class="form-control mt-2" name="file">


<select class="form-control mt-2" name="lok">
<option value="0">ویدیو رایگان است؟...</option>
<option value="0">بله</option>
<option value="1">خیر</option>
</select>


<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره اطلاعات</button>
</form>
