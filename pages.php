<table class="table table-striped text-center">
<thead>
<tr>
<th>نام صفحه</th>
<th>ویراش</th>
<th>نمایش صفحه</th>
<th>حذف</th>
</tr>
</thead>
<tbody>
<?php
try{
$readdb = $conn->query("select * from posts where type=1");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>            
<tr>
<td><?php echo $information->title ?></td>
<td><a href="pages-edit.php?id=<?php echo $information->id ?>"><button type="button" class="btn btn-primary btn-sm">ویرایش</button></a></td>
<td><a target="_blank" href="page.php?id=<?php echo $information->id ?>"><button type="button" class="btn btn-primary btn-sm">
    <i class="bi bi-box-arrow-up-right"></i>
</button></a></td>
<td>
    

<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $information->id ?>"><i class="bi bi-trash3"></i></button>


<!-- The Modal -->
<div class="modal fade" id="myModal<?php echo $information->id ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">حذف</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
آیا از حذف این مورد اطمینان دارید؟ اطلاعات قابل بازیابی نخواهند بود!
</div>

<!-- Modal footer -->
<div class="modal-footer">




<?php
if(isset($_POST['delete'])){
$id_for_del = $_POST['id_for_del'];
$rejister_form = $conn->prepare("DELETE FROM posts WHERE id = :id ");
$rejister_form->execute([
'id' => $id_for_del,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>


<form action="" method="post">
<input name="id_for_del" value="<?php echo $information->id ?>" style="display:none;">
<button type="submit" name="delete" class="btn btn-danger">بله حذف میکنم</button>
</form>

</div>

</div>
</div>
</div>


</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
