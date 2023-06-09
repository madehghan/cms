
<?php
try{
if(isset($_POST['new'])){

$title = $_POST['title'];
$content = $_POST['content'];
$insertdb = $conn->prepare("INSERT INTO `news` (title,content) values (:title,:content)");
$insertdb->execute([
'title' => $title,
'content' => $content,
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
<textarea  class="form-control mt-2" name="content" style="height:30vh" placeholder="متن اطلاعیه"></textarea>

<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">ذخیره اطلاعات</button>
</form>
