


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
where id = $my_profile_id 
");
@$rejister_form->execute([
    'avatar' => $iimage,
]);
echo "<meta http-equiv='refresh' content='0'>";

}
?>





<form action="" method="post" enctype="multipart/form-data">
<center>

<input name="id_profile" value="<?php echo $user_show->id ?>" style="display:none;" type="text" class="form-control" placeholder="">


<label for="file">


<img src="<?php echo $my_profile_avatar ?>"  width="200px" height="200px" style="border-radius:100%;">

<input type="file" name="avatar" id="file" class="inputfile">
<br>
</label>
</center>



    <button type="submit" name="update_avatar" class="btn btn-warning w-100 mb-2 mt-2">به روزرسانی تصویر پروفایل</button>



</form>
