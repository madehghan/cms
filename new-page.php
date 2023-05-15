<?php include 'modules/new-page.php' ?>



<?php
try{
    
if(isset($_POST['new'])){
$title = $_POST['title'];
$content = $_POST['content'];
$insertdb = $conn->prepare("INSERT INTO `pages` (title,content) values (:title,:content)");
$insertdb->execute([
'title' => $title,
'content' => $content,
]);

echo "<div class='alert alert-success'>";
echo "<strong>Success</strong> Published!";
echo "</div>";
}

}catch(Exception $e){
echo  $e->getMessage();
}
?>


<form action="" method="POST">
<input type="" name="title" class="form-control mt-2 mb-2" placeholder="Title">
<textarea  class="form-control mt-2" name="content" placeholder="Content"></textarea>

<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">Publish</button>
</form>
