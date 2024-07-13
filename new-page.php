
<?php
try{
    
if(isset($_POST['new'])){
$title = $_POST['title'];
$content = $_POST['content'];
$insertdb = $conn->prepare("INSERT INTO pages (title,content) values (:title,:content)");
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
<input type="" name="title" class="form-control mt-2 mb-2" placeholder="عنوان">
<textarea  class="form-control mt-2" name="content" placeholder="توضیحات"></textarea>

<button type="submit" name="new" class="btn btn-primary mt-2 w-100 btn-sm">انتشار</button>
</form>

CREATE TABLE pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) DEFAULT NULL,
    content TEXT DEFAULT NULL
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
