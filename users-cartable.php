
<style>
    .inputfile {
  /* visibility: hidden etc. wont work */
  width: 0.1px;
  height: 0.1px;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}
.inputfile:focus + label {
  /* keyboard navigation */
  outline: 1px dotted #000;
  outline: -webkit-focus-ring-color auto 5px;
}
.inputfile + label * {
  pointer-events: none;
}
</style>


<?php 
if(isset($_POST['update_avatar'])){

if(file_exists($_FILES['avatar']['tmp_name'])){
    $path = 'uploads/'.time();
    $path .= $_FILES['avatar']['name'];
    if(!is_dir('uploads')){
      mkdir('uploads');
    }
  if(move_uploaded_file($_FILES['avatar']['tmp_name'], $path)){      

     $iimage =  $path;
  }else{      
  }
}else{
}

$id_profileme = $_POST['id_profile'];
@$rejister_form = $conn->prepare("UPDATE `users` SET 
`avatar` = :avatar 
where id = $id_profileme 
");
@$rejister_form->execute([
    'avatar' => $iimage,
]);
echo "<meta http-equiv='refresh' content='0'>";

}
?>


<?php
try{
$getid = $_GET['id'];
$readdb = $conn->query("select * from users where id = $getid");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $user_show) :?>


<form action="" method="post" enctype="multipart/form-data">
<center>

<input name="id_profile" value="<?php echo $user_show->id ?>" style="display:none;" type="text" class="form-control" placeholder="">


<label for="file">


<img src="<?php echo $user_show->avatar ?>"  width="200px" height="200px" style="border-radius:100%;">

<input type="file" name="avatar" id="file" class="inputfile">
<br>
</label>
</center>



    <button type="submit" name="update_avatar" class="btn btn-warning w-100 mb-2 mt-2">به روزرسانی تصویر پروفایل</button>



</form>


<hr>



<?php
      try{
          $id_profile = $_GET['id'];
        $profile_errors = [];
        if(isset($_POST['update_user_submit']) && !empty($_POST['password'])){
            $id_profile = $_POST['id_profile'];
            $name_profile = $_POST['name_profile'];
            $email_profile = $_POST['email_profile'];
            $adress_profile = $_POST['adress_profile'];
            $password_new = md5($password_profile);
            $role_profile = $_POST['role_profile'];
            $status_profile = $_POST['status_profile'];
            $password = $_POST['password'];
            $users_up_get = $conn->prepare("UPDATE `users` SET `name` = :name_profile , `email` = :email_profile , `adress` = :adress_profile , `role` = :role_profile , `status` = :status_profile , `password` = :password WHERE `id` = $id_profile ");
            $users_up_get->execute([
                'name_profile' => $name_profile,
                'email_profile' => $email_profile,
                'adress_profile' => $adress_profile,
                'role_profile' => $role_profile,
                'status_profile' => $status_profile,
                'password' => md5($password),
            ]);
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if(isset($_POST['update_user_submit']) && empty($_POST['static_password'])){
            $id_profile = $_POST['id_profile'];
            $name_profile = $_POST['name_profile'];
            $email_profile = $_POST['email_profile'];
            $adress_profile = $_POST['adress_profile'];
            $password_new = md5($password_profile);
            $role_profile = $_POST['role_profile'];
            $status_profile = $_POST['status_profile'];
            $password = $_POST['password'];
            $users_up_get = $conn->prepare("UPDATE `users` SET `name` = :name_profile , `email` = :email_profile , `adress` = :adress_profile , `role` = :role_profile , `status` = :status_profile WHERE `id` = $id_profile ");
            $users_up_get->execute([
                'name_profile' => $name_profile,
                'email_profile' => $email_profile,
                'adress_profile' => $adress_profile,
                'role_profile' => $role_profile,
                'status_profile' => $status_profile,
            ]);
            echo "<meta http-equiv='refresh' content='0'>";
        }
      }catch(Exception $e){
        echo  $e->getMessage();
      }
      ?>


      <form action="" method="post">

<input style="display: none;" name="id_profile" value="<?php echo $user_show->id ?>" type="text" class="form-control" placeholder="">

نام و نام خانوادگی:
<input name="name_profile" value="<?php echo $user_show->name ?>" type="text" class="form-control" placeholder="نام و نام خانوادگی">

شماره موبایل:
<input value="<?php echo $user_show->phone_number ?>" type="text" class="form-control" placeholder="شماره موبایل">

ایمیل:
<input name="email_profile" value="<?php echo $user_show->email ?>" type="email" class="form-control" placeholder="ایمیل" disabled>

آدرس:
<input name="adress_profile" value="<?php echo $user_show->adress ?>" type="text" class="form-control" placeholder="آدرس">

درباره:
<textarea name="techer_description"  class="form-control"><?php echo $user_show->techer_description	 ?></textarea>

کلمه عبور جدید:
<input name="password" type="text" class="form-control" placeholder="کلمه عبور جدید را وارد کنید">

<div class="form-group">
  <label for="sel1">وضعیت حساب کاربری:
      
    <?php if($user_show->status == 1) : ?>
    <span class="right badge badge-success">
      فعال
    </span>
      <?php endif ?>
      
    <?php if($user_show->status == 0) : ?>
    <span class="right badge badge-danger">
      غیرفعال
    </span>
      <?php endif ?>
      
  </label>
  <select class="form-control" id="sel1" name="status_profile">
    <option value="1">فعالسازی</option>
    <option value="0">غیرفعالسازی</option>
  </select>
</div>


<div class="form-group">
  <label for="sel1">نوع حساب کاربری:
      
  </label>
  <select class="form-control" id="sel1" name="role_profile">
    <?php if($user_show->role==1) : ?>
    <option value="1">مدیرکل</option>
      <?php endif ?>
    <?php if($user_show->role==2) : ?>
    <option value="2">نماینده</option>
      <?php endif ?>
    <?php if($user_show->role==3) : ?>
    <option value="3">اساتید</option>
      <?php endif ?>
    <?php if($user_show->role==4) : ?>
    <option value="4">دانشجو</option>
      <?php endif ?>
    <option value="0">-</option>
<?php
try{
$readdb = $conn->query("select * from roles");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<option value="<?php echo $information->id ?>"><?php echo $information->title ?></option>
<?php endforeach; ?>
  </select>
</div>


        
<input name="update_user_submit" value="به روز رسانی پروفایل" type="submit" class="btn btn-primary btn-block btn-flat mt-3 w-100">

</form>

<?php endforeach; ?>
