-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 20, 2024 at 09:42 PM
-- Server version: 5.7.44-log
-- PHP Version: 8.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bavokala_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text,
  `answer` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





<div class="titlebar"><div class="titlebar_icon"><i class="bi bi-caret-left-fill"></i></div>سوال و جواب های متداول</div>
<div id="accordion">
<?php
try{
    $readdb = $conn->query("select * from faqs");
    $read_db = $readdb->fetchAll(PDO::FETCH_OBJ);
}catch(Exception $e){
    echo  $e->getMessage();
}
?>

<?php foreach($read_db as $index => $information_faqs) : ?>
  <div class="card mb-2">
    <div class="card-header">
      <a class="btn" data-bs-toggle="collapse" href="#faq<?php echo $information_faqs->id ?>">
        <?php echo $information_faqs->question ?>
      </a>
    </div>
    <div id="faq<?php echo $information_faqs->id ?>" class="collapse <?php echo $index === 0 ? 'show' : ''; ?>" data-bs-parent="#accordion">
      <div class="card-body">
        <?php echo $information_faqs->answer ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>

</div>

