
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
  /* Style for the boxes */
  .box {
    width: 50px;
    height: 50px;
    background-color: lightgray;
    display: inline-block;
    margin: 10px;
    cursor: pointer;
  }

  /* Style for the fullscreen image */
  #fullscreen-image {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: none;
    z-index: 999;
    opacity: 0;
    transition: opacity 0.5s;
  }

  #fullscreen-image.show {
    display: block;
    opacity: 1;
  }

  #fullscreen-image img {
    display: block;
    max-width: 90%;
    max-height: 90%;
    margin: auto;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    opacity: 0;
    transition: opacity 0.5s;
  }

  #fullscreen-image img.show {
    opacity: 1;
  }

  #timer {
    color: white;
    font-size: 20px;
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
  }

  #navigation {
    color: white;
    font-size: 30px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 0 20px;
    box-sizing: border-box;
  }

  #navigation .icon {
    cursor: pointer;
      z-index: 100;
  }

  #exit-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    color: white;
    font-size: 30px;
    cursor: pointer;
  }
</style>

<style>
    .story_bg {
        overflow-x: auto;
        white-space: nowrap; /* Optional: Prevent line breaks */
    }
</style>


<div class="story_bg">
<?php
try{
$readdb = $conn->query("select * from stories order by id limit 4");
$read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db as $information) :?>
<div class="box" onclick="showFullscreenImage(<?php echo ($information->id-1) ?>)" style="border:4px solid #fff;background-image: url('<?php echo $information->image ?>');background-size: cover;border-radius: 100%;">
</div>
<?php endforeach; ?>

<div id="fullscreen-image">
  <div id="navigation">
    <span class="icon" onclick="showNextImage()"><i class="fas fa-chevron-right"></i></span>
    <span class="icon" onclick="showPreviousImage()"><i class="fas fa-chevron-left"></i></span>
  </div>
  <div id="exit-icon" onclick="exitFullscreenImage()"><i class="fas fa-times-circle"></i></div>
  <img id="fullscreen-img" src="" alt="Fullscreen Image">
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
  var images = [
<?php
try{
$readdb = $conn->query("select * from stories order by id limit 4");
$read_db2 = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
echo  $e->getMessage();
}
?>
<?php foreach($read_db2 as $information2) :?>
    "<?php echo $information2->image ?>",
<?php endforeach; ?>
  ];

  var currentIndex = 0;
  var timer;
  var seconds = 3;

  function showFullscreenImage(index) {
    var fullscreenImage = document.getElementById("fullscreen-image");
    var fullscreenImg = document.getElementById("fullscreen-img");
    var timerElement = document.getElementById("timer");

    fullscreenImg.src = images[index];
    currentIndex = index;
    fullscreenImage.classList.add("show");
    fullscreenImg.classList.add("show");
    timerElement.textContent = seconds;
    startTimer();
  }

  function showNextImage() {
    clearTimeout(timer);
    currentIndex = (currentIndex + 1) % images.length;
    var fullscreenImg = document.getElementById("fullscreen-img");
    fullscreenImg.classList.remove("show");
    setTimeout(function() {
      showFullscreenImage(currentIndex);
    }, 500);
  }

  function showPreviousImage() {
    clearTimeout(timer);
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    var fullscreenImg = document.getElementById("fullscreen-img");
    fullscreenImg.classList.remove("show");
    setTimeout(function() {
      showFullscreenImage(currentIndex);
    }, 500);
  }

  function exitFullscreenImage() {
    clearTimeout(timer);
    var fullscreenImage = document.getElementById("fullscreen-image");
    fullscreenImage.classList.remove("show");
  }

  function startTimer() {
    var timerElement = document.getElementById("timer");
    seconds = 10;
    timerElement.textContent = seconds;
    timer = setInterval(function() {
      seconds--;
      if (seconds <= 0) {
        clearInterval(timer);
        showNextImage();
      } else {
        timerElement.textContent = seconds;
      }
    }, 1000);
  }

  document.getElementById("fullscreen-image").onclick = function() {
    event.stopPropagation();
    exitFullscreenImage();
  };

  document.querySelector("#navigation .icon:first-child").onclick = function(event) {
    event.stopPropagation();
    showPreviousImage();
  };

  document.querySelector("#navigation .icon:last-child").onclick = function(event) {
    event.stopPropagation();
    showNextImage();
  };

  document.getElementById("exit-icon").onclick = function(event) {
    event.stopPropagation();
    exitFullscreenImage();
  };
</script>

</div>
