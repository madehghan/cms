
<?php include 'modules/page-edit.php' ?>

<?php
if(isset($_POST['update']) && !file_exists($_FILES['file']['tmp_name'])){
try{
    
$getid = $_POST['getid'];
$title = $_POST['title'];
$content = $_POST['content'];
$updatedb = $conn->prepare("UPDATE `pages` SET 
`title` = :title ,
`content` = :content 
WHERE id = $getid ");
$updatedb->execute([
'title' => $title,
'content' => $content,
]);

echo "<meta http-equiv='refresh' content='0'>";

}catch(Exception $e){
echo  $e->getMessage();
}
}

?>



<?php
$get_id = $_GET['id'];
try{
$readdb = $conn->query("select * from pages where id=$get_id");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<form action="" method="POST"  enctype="multipart/form-data">
<input value="<?php echo $information->id ?>" name="getid" style="display:none;">
<input type="text" name="title" class="form-control mt-2 mb-2" value="<?php echo $information->title ?>" placeholder="تیتر صفحه">
<textarea  class="form-control mt-2 mb-2" name="content"><?php echo $information->content ?></textarea>

<button type="submit" name="update" class="btn btn-primary mt-2 w-100 btn-sm">به روز رسانی</button>
</form>
<?php endforeach; ?>

