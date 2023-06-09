//show contacts
<style>
    .centered {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom:10px;
  border-bottom:1px solid #c3c3c3;
  padding:10px;
}

</style>




<?php
try{
$readdb = $conn->query("select * from users");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?> 
<?php if($information->id != $my_profile_id):?>
    <div class="row">
        <a href="messages.php?user1=<?php echo $my_profile_id ?>&user2=<?php echo $information->id ?>" style="color:#212121">
<div class="centered">
        <div class="col-2"><img src="<?php echo $information->avatar ?>" class="w-75" style="border-radius:100%"></div>
        <div class="col-10"><?php echo $information->name ?></div>
    </div>
        </a>
</div>
<?php endif?>
<?php endforeach; ?>
