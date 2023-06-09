
<?php
$get_id = $_GET['cloud'];
?>



<h3 class="titles">مدیریت فایل

<button type="button" class="btn btn-primary btnme"  data-toggle="modal" data-target="#newfolder"><i class="bi bi-folder-plus"></i></button>

<button type="button" class="btn btn-primary btnme"  data-toggle="modal" data-target="#newfile"><i class="bi bi-cloud-arrow-up-fill"></i></button>

<button type="button" class="btn btn-primary btnme"  data-toggle="modal" data-target="#logfiles"><i class="bi bi-list-ul"></i></button>

</h3>


<!-- The Modal -->
<div class="modal fade" id="logfiles">
<div class="modal-dialog modal-dialog-centered  modal-xl">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">لاگ آپلود فایل</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
           
<table class="table table-striped">
    <thead>
      <tr class="text-center">
        <th>نام فایل</th>
        <th>نام پوشه</th>
        <th>تاریخ آپلود</th>
        <th>کاربر</th>
      </tr>
    </thead>
    <tbody>
        
                                                      
    <?php
      try{
        $users_show = $conn->query("select * from cloud_files");
        $users = $users_show->fetchAll(PDO::FETCH_OBJ);
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>

      <?php foreach($users as $show_fileslog) :?>
      <tr class="text-center">
        <td><?php echo $show_fileslog->file ?></td>


        <td>                             
    <?php
      try{
        $get_folder_name = $show_fileslog->folder_id;
        $users_show = $conn->query("select * from cloud_folders where id = $get_folder_name");
        $users = $users_show->fetchAll(PDO::FETCH_OBJ);
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>

      <?php foreach($users as $show_fileslog_folder) :?>
        <?php echo $show_fileslog_folder->title ?>
    <?php endforeach ?>
        </td>


        <td><?php echo $show_fileslog->date ?> ساعت <?php echo $show_fileslog->time ?></td>
        <td>                             
    <?php
      try{
        $get_userid_name = $show_fileslog->user_id;
        $users_show = $conn->query("select * from users where id = $get_userid_name");
        $users = $users_show->fetchAll(PDO::FETCH_OBJ);
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>

      <?php foreach($users as $show_fileslog_user_id) :?>
        <?php echo $show_fileslog_user_id->name ?>
    <?php endforeach ?>
        </td>
      </tr>
      <?php endforeach; ?>

      
    </tbody>
  </table>
</div>

</div>
</div>
</div>





<?php if(isset($_POST['send_request'])){
@$title = $_POST['title'];
@$content = $_POST['content'];
@$status = $_POST['status'];
$get_folder = $_GET['cloud'];
@$rejister_form = $conn->prepare("INSERT INTO cloud_folders (title,user_id,date,folder_id) values ( :title , :user_id , :date , :folder_id)");
@$rejister_form->execute([
'title' => $title,
'user_id' => $my_profile_id,
'date' => $persian_time,
'folder_id' => $get_folder,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>


<!-- The Modal -->
<div class="modal fade" id="newfolder">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">ایجاد پوشه جدید</h4>
</div>

<!-- Modal body -->
<div class="modal-body">

<form action="" method="POST">
<div class="form-group mb-3">
<input type="text" name="title" class="form-control" placeholder="عنوان پوشه" id="email">
</div>

<button type="submit" name="send_request" class="btn btn-primary w-100">ایجاد پوشه</button>
</form>


</div>

</div>
</div>
</div>








<?php if(isset($_POST['newfile_send'])){


if(file_exists($_FILES['file']['tmp_name'])){
$path = 'uploads/'.time();
$path .= $_FILES['file']['name'];
if(!is_dir('uploads')){
mkdir('uploads');
}
if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){      

$iimage =  $path;
}else{      
}
}else{
}


@$folder_id = $_GET['cloud'];
@$rejister_form = $conn->prepare("INSERT INTO cloud_files (file,folder_id,user_id,date,time) values ( :file , :folder_id , :user_id , :date, :time)");
@$rejister_form->execute([
'file' => $iimage,
'folder_id' => $folder_id,
'user_id' => $my_profile_id,
'date' => $message_date,
'time' => $message_time,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>



<!-- The Modal -->
<div class="modal fade" id="newfile">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">آپلود فایل جدید</h4>
</div>

<!-- Modal body -->
<div class="modal-body">

<form action="" method="POST"  enctype="multipart/form-data">
<div class="form-group mb-3">
<input type="file" name="file" class="form-control" placeholder="عنوان پوشه" id="email">
</div>

       
<div class="form-group">
<label for="sel1">کنترل دسترسی به فایل:</label>
<select class="form-control" id="sel1" multiple>
  <option value="1">همه کاربران</option>                                                         
    <?php
      try{
        $users_show = $conn->query("select * from users");
        $users = $users_show->fetchAll(PDO::FETCH_OBJ);
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>

      <?php foreach($users as $user_show1) :?>
  <option value="<?php echo $user_show1->id ?>"><?php echo $user_show1->name ?></option>
  <?php endforeach ?>
</select>
</div>




<button type="submit" name="newfile_send" class="btn btn-primary w-100">آپلود فایل</button>
</form>


</div>

</div>
</div>
</div>





<hr>


<div class="row">


<?php
try{
$result = $conn->query("select * from cloud_folders where user_id = $my_profile_id  and folder_id = $get_id");
$infos = $result->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<?php foreach($infos as $infos_files) :?>
<div class="col-sm-2">
<center>
<a href="cloud.php?cloud=<?php echo $infos_files->id ?>">
<i class="bi bi-folder" style="font-size:100px;"></i>
<br>
<div style="margin-top:-50px;margin-bottom:-20px;"><?php echo $infos_files->title ?></div>
</a>


<br>
<button type="button" class="btn btn-danger" style="font-size:10px" data-toggle="modal" data-target="#delete_folder<?php echo $infos_files->id ?>"><i class="bi bi-trash"></i></button>

<button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#move_folder<?php echo $infos_files->id ?>"><i class="bi bi-arrows-move"></i></button>






<!-- The Modal -->
<div class="modal fade" id="delete_folder<?php echo $infos_files->id ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">حذف داکیومنت</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
آیا از حذف این مورد اطمینان دارید؟ اطلاعات قابل بازیابی نخواهند بود!
</div>

<!-- Modal footer -->
<div class="modal-footer">




<?php
if(isset($_POST['chklst_delete'])){
$id_for_del = $_POST['id_for_del'];
$rejister_form = $conn->prepare("DELETE FROM cloud_folders WHERE id = :id ");
$rejister_form->execute([
'id' => $id_for_del,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>


<form action="" method="post">
<input name="id_for_del" value="<?php echo $infos_files->id ?>" style="display:none;">
<button type="submit" name="chklst_delete" class="btn btn-danger">بله حذف میکنم</button>
</form>

</div>

</div>
</div>
</div>





<!-- The Modal -->
<div class="modal fade" id="move_folder<?php echo $infos_files->id ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">انتقال فایل</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
    


<?php 
$file_id_dupp = $infos_files33->id;
if(isset($_POST["move_file".$file_id_dupp])){
@$folder_move_id = $_POST['folder_move_id'];
@$file_id = $_POST['file_id'];
@$rejister_form = $conn->prepare(" UPDATE `cloud_folders` SET `folder_id` = :folder_id where id = :id ");
@$rejister_form->execute([
'folder_id' => $folder_move_id,
'id' => $file_id,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>




<form action="" method="post">
<input name="file_id" value="<?php echo $infos_files->id ?>" style="display:none;">

<div class="form-group">
<label for="sel1">محل انتقال را انتخاب نمایید:</label>
<select class="form-control" id="sel1" name="folder_move_id">
  <option value="#">انتخاب پوشه</option> 
  <option value="0">روت اصلی</option>                                                        
    <?php
      try{
        $users_show = $conn->query("select * from cloud_folders");
        $users = $users_show->fetchAll(PDO::FETCH_OBJ);
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>
      <?php foreach($users as $user_show5) :?>
  <option value="<?php echo $user_show5->id ?>"><?php echo $user_show5->title ?></option>
  <?php endforeach ?>
</select>
</div>

<button type="submit" name="move_file<?php echo $infos_files33->id ?>" class="btn btn-success">انتقال فایل</button>
</form>


</div>

<!-- Modal footer -->
<div class="modal-footer">






</div>

</div>
</div>
</div>








</center>
</div>
<?php endforeach; ?>

</div>




<div class="row">
<?php
try{
$result = $conn->query("select * from cloud_files where user_id = $my_profile_id  and folder_id = $get_id");
$infos = $result->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>

<?php foreach($infos as $infos_files33) :?>
<div class="col-sm-2 mt-5">
<center>
<a href="<?php echo $infos_files33->file ?>">
<i class="bi bi-file-earmark-fill" style="font-size:100px;"></i>
<br>
<div style="margin-top:-50px;margin-bottom:-20px;"><?php echo $infos_files33->title ?></div>
</a>

<br>


<button type="button" class="btn btn-danger" style="font-size:10px" data-toggle="modal" data-target="#delete_file<?php echo $infos_files33->id ?>"><i class="bi bi-trash"></i></button>

<button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#move<?php echo $infos_files33->id ?>"><i class="bi bi-arrows-move"></i></button>

<button type="button" class="btn btn-primary" style="font-size:10px" data-toggle="modal" data-target="#copy<?php echo $infos_files33->id ?>"><i class="bi bi-journals"></i></button>






<!-- The Modal -->
<div class="modal fade" id="delete_file<?php echo $infos_files33->id ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">حذف داکیومنت</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
آیا از حذف این مورد اطمینان دارید؟ اطلاعات قابل بازیابی نخواهند بود!
</div>

<!-- Modal footer -->
<div class="modal-footer">




<?php
if(isset($_POST['chklst_delete'])){
$id_for_del = $_POST['id_for_del'];
$rejister_form = $conn->prepare("DELETE FROM cloud_files WHERE id = :id ");
$rejister_form->execute([
'id' => $id_for_del,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>


<form action="" method="post">
<input name="id_for_del" value="<?php echo $infos_files33->id ?>" style="display:none;">
<button type="submit" name="chklst_delete" class="btn btn-danger">بله حذف میکنم</button>
</form>

</div>

</div>
</div>
</div>










<!-- The Modal -->
<div class="modal fade" id="copy<?php echo $infos_files33->id ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">کپی کردن فایل</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
    کپی کردن این فایل مورد تایید است؟
</div>

<!-- Modal footer -->
<div class="modal-footer">




<?php 
$file_id_dupp = $infos_files33->id;
if(isset($_POST["dupplicate_file".$file_id_dupp])){
@$folder_id = $_GET['cloud'];
@$file_name = $_POST['file_name'];
@$rejister_form = $conn->prepare("INSERT INTO cloud_files (file,folder_id,user_id,date,time) values ( :file , :folder_id , :user_id , :date, :time)");
@$rejister_form->execute([
'file' => $file_name,
'folder_id' => $folder_id,
'user_id' => $my_profile_id,
'date' => $message_date,
'time' => $message_time,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>




<form action="" method="post">
<input name="file_name" value="<?php echo $infos_files33->file ?>" style="display:none;">
<button type="submit" name="dupplicate_file<?php echo $infos_files33->id ?>" class="btn btn-success">بله کپی شود!</button>
</form>

</div>

</div>
</div>
</div>








<!-- The Modal -->
<div class="modal fade" id="move<?php echo $infos_files33->id ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<!-- Modal Header -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">انتقال فایل</h4>
</div>

<!-- Modal body -->
<div class="modal-body">
    


<?php 
$file_id_dupp = $infos_files33->id;
if(isset($_POST["move_file".$file_id_dupp])){
@$folder_move_id = $_POST['folder_move_id'];
@$file_id = $_POST['file_id'];
@$rejister_form = $conn->prepare(" UPDATE `cloud_files` SET `folder_id` = :folder_id where id = :id ");
@$rejister_form->execute([
'folder_id' => $folder_move_id,
'id' => $file_id,
]);
echo "<meta http-equiv='refresh' content='0'>";
}
?>




<form action="" method="post">
<input name="file_id" value="<?php echo $infos_files33->id ?>" style="display:none">

<div class="form-group">
<label for="sel1">محل انتقال را انتخاب نمایید:</label>
<select class="form-control" id="sel1" name="folder_move_id">
  <option value="#">انتخاب پوشه</option>                                                         
    <?php
      try{
        $users_show = $conn->query("select * from cloud_folders");
        $users = $users_show->fetchAll(PDO::FETCH_OBJ);
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>
      <?php foreach($users as $user_show5) :?>
  <option value="<?php echo $user_show5->id ?>"><?php echo $user_show5->title ?></option>
  <?php endforeach ?>
</select>
</div>

<button type="submit" name="move_file<?php echo $infos_files33->id ?>" class="btn btn-success">انتقال فایل</button>
</form>


</div>

<!-- Modal footer -->
<div class="modal-footer">






</div>

</div>
</div>
</div>









</center>
</div>

<?php endforeach; ?>
</div>

