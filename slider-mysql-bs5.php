<div id="carouselExample" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $stmt = $conn->query("SELECT * FROM sliders");
        $first = true;
        $slideNumber = 0; // Initialize slideNumber for indicators

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $active = $first ? 'active' : '';
            echo "<div class='carousel-item $active'>";
            echo "<img src='{$row['image_path']}' class='d-block w-100 rounded' alt=''>";
            echo "</div>";
            $first = false;
            $slideNumber++;
        }
        ?>
    </div>
    <div class="carousel-indicators">
        <?php
        for ($i = 0; $i < $slideNumber; $i++) {
            $active = $i === 0 ? 'active' : '';
            echo "<button type='button' data-bs-target='#carouselExample' data-bs-slide-to='$i' class='$active'></button>";
        }
        ?>
    </div>
</div>
