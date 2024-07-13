
<?php
$getid = $_GET['id'];
try{
$readdb = $conn->query("select * from pages where id=$getid");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>


<?php
if(isset($_POST['update'])){
try{
$updatedb = $conn->prepare("UPDATE `pages` SET 
`title` = :title ,
`content` = :content 
WHERE id = $getid ");
$updatedb->execute([
'title' => $_POST['title'],
'content' => $_POST['content'],
]);


echo "<meta http-equiv='refresh' content='0'>";

}catch(Exception $e){
echo  $e->getMessage();
}
}
?>


<form action="" method="POST">
<input type="" name="title" class="form-control mt-2 mb-2" value="<?php echo $information->title ?>" placeholder="عنوان">
<textarea  class="form-control mt-2" name="content" placeholder="توضیحات" style="height:200px;"><?php echo $information->content ?></textarea>
<button type="submit" name="update" class="btn btn-primary mt-2 w-100 btn-sm">به روز رسانی</button>
</form>
<?php endforeach; ?>

