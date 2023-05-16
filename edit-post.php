
<?php include 'modules/post-edit.php' ?>






<?php
if(isset($_POST['update']) && file_exists($_FILES['file']['tmp_name'])){
try{
    
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

$getid = $_POST['getid'];
$title = $_POST['title'];
$description = $_POST['description'];
$updatedb = $conn->prepare("UPDATE `news` SET 
`title` = :title ,
`image` = :image ,
`description` = :description 
WHERE id = $getid ");
$updatedb->execute([
'title' => $title,
'description' => $description,
'image' => $file,
]);

echo "<meta http-equiv='refresh' content='0'>";

}catch(Exception $e){
echo  $e->getMessage();
}
}





if(isset($_POST['update']) && !file_exists($_FILES['file']['tmp_name'])){
try{
    
$getid = $_POST['getid'];
$title = $_POST['title'];
$description = $_POST['description'];
$updatedb = $conn->prepare("UPDATE `news` SET 
`title` = :title ,
`description` = :description 
WHERE id = $getid ");
$updatedb->execute([
'title' => $title,
'description' => $description,
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
$readdb = $conn->query("select * from news where id=$get_id");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<form action="" method="POST"  enctype="multipart/form-data">
<input value="<?php echo $information->id ?>" name="getid" style="display:none;">
<input type="text" name="title" class="form-control mt-2 mb-2" value="<?php echo $information->title ?>" placeholder="تیتر صفحه">
<textarea  class="form-control mt-2 mb-2" name="description"><?php echo $information->description ?></textarea>

<input type="file" class="form-control mt-2" name="file">

<button type="submit" name="update" class="btn btn-primary mt-2 w-100 btn-sm">به روز رسانی</button>
</form>
<?php endforeach; ?>


