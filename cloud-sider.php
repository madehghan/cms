
<?php
try{
$result = $conn->query("select * from cloud_folders where user_id = $my_profile_id  and folder_id = 0");
$infos = $result->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<?php foreach($infos as $infos_files_right) :?>

<div class="mr-3">
<a href="?cloud=<?php echo $infos_files_right->id ?>">
<div class="row text-right mb-2">
<div class="col-1 text-left p-1"><i class="bi bi-folder-fill" style="color:#FCD461;"></i></div>
<div class="col-11">./<?php echo $infos_files_right->title ?></div>
</div>
</a>
</div>
  


<?php
try{
$get_id_folder_moth = $infos_files_right->id;
$result = $conn->query("select * from cloud_folders where folder_id = $get_id_folder_moth");
$infos = $result->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<?php foreach($infos as $infos_files_right_1) :?>
<div class="mr-5">
<a href="?cloud=<?php echo $infos_files_right_1->id ?>">
<div class="row text-right mb-2">
<div class="col-1 text-left p-1"><i class="bi bi-folder-fill" style="color:#FCD461;"></i></div>
<div class="col-11">../<?php echo $infos_files_right_1->title ?></div>
</div>
</a>
</div>
<?php endforeach; ?>

<?php endforeach; ?>
