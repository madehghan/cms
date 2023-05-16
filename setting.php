
<?php include 'modules/setting.php' ?>




<?php
if(isset($_POST['update'])){
try{
$site_name = $_POST['site_name'];
$site_description = $_POST['site_description'];
$updatedb = $conn->prepare("UPDATE `settings` SET 
`site_name` = :site_name ,
`site_description` = :site_description 
WHERE id = 1 ");
$updatedb->execute([
'site_name' => $site_name,
'site_description' => $site_description,
]);

echo "<meta http-equiv='refresh' content='0'>";

}catch(Exception $e){
echo  $e->getMessage();
}
}
?>


<?php
$get_id = 1;
try{
$readdb = $conn->query("select * from settings where id=$get_id");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<form action="" method="POST">
<input value="<?php echo $information->id ?>" name="getid" style="display:none;">
<input type="text" name="site_name" class="form-control mt-2" value="<?php echo $information->site_name ?>" placeholder="نام سایت">
<input type="text" name="site_description" class="form-control mt-2" value="<?php echo $information->site_description ?>" placeholder="توضیحات سایت">
<button type="submit" name="update" class="btn btn-primary mt-2 w-100 btn-sm">به روز رسانی</button>
</form>
<?php endforeach; ?>

