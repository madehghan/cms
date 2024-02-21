
.horizontal-scroll-container {
    overflow-x: auto;
    white-space: nowrap;
    width: 100%; /* Adjust the width as needed */
}

.row {
    display: flex;
    flex-wrap: nowrap;
}

<div class="horizontal-scroll-container">
    <div class="row">
        <?php
        try {
            $readdb = $conn->query("select * from posts order by id desc");
            $read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            echo  $e->getMessage();
        }
        ?>
        <?php foreach ($read_db as $information_blog) : ?>
            <div class="col-8">
                <a href="post?id=<?php echo $information_blog->id ?>">
                    <div class="bg-post-dashboard">
                        <img src="<?php echo $information_blog->image ?>" class="w-100 rounded">
                        <div class="post-title-dashboard"><?php echo $information_blog->title ?></div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
