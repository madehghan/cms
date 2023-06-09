
<?php
try{
$readdb = $conn->query("select * from news order by id desc");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<div class="alert alert-primary">
  <strong><?php echo $information->title ?></strong>
  <br><?php echo $information->content ?>
  <hr><div style="font-size:10px;font-family:is"><?php echo $information->date ?></div>
</div>
<?php endforeach; ?>
