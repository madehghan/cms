<table class="table table-striped text-center">
<thead>
<tr>
<th>نام کاربر</th>
<th>نقش</th>
<th>کارتابل</th>
</tr>
</thead>
<tbody>
<?php
try{
$readdb = $conn->query("select * from users");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>            
<tr>
<td><?php echo $information->name ?></td>
<td>
    

<?php
try{
$get_role_id = $information->role;
$readdb = $conn->query("select * from roles where id=$get_role_id");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information2) :?>
    <span class="badge bg-primary">
    <?php echo $information2->title ?>
    </span>
<?php endforeach; ?>


</td>
<td><a href="cartable.php?id=<?php echo $information->id ?>"><button type="button" class="btn btn-warning btn-sm"><i class="bi bi-person-bounding-box"></i></button></a></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
