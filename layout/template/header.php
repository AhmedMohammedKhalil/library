<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo $pageTitle?></title>
    	<link rel="stylesheet" href="<?php echo $css?>style.css" />
		</head>
    
	<body>

  <header class="header" id="header">
      <div class="container">
        <ul class="menu">
          <li><a href="<?php echo $app ?>index.php">Home</a></li>
          <li><a href="<?php echo $app ?>index.php#about_us ">About US</a></li>
          <li><a href="books.html">Books</a></li>
        </ul>
        <a href="<?php echo $app ?>index.php" class="logo">Student Library</a>
        <ul class="menu">
          <?php if(!isset($_SESSION['username'])) { ?>
            <li><a href="<?php echo $cont.'StudentController.php?method=showLogin'?>">Student Login</a></li>
            <li><a href="<?php echo $cont.'AdminController.php?method=showLogin'?>">Admin Login</a></li>
          <?php }?>
          <?php if(isset($_SESSION['admin']) || isset($_SESSION['sub_admin'])) { ?>
            <li><a href="<?php echo $cont.'AdminController.php?method=dashboard'?>">Dashboard</a></li>
            <li><a href="<?php echo $cont.'AdminController.php?method=logout'?>">Logout</a></li>
		      <?php } ?>
          <?php if(isset($_SESSION['student'])) { ?>
            <li><a href="<?php echo $cont.'StudentController.php?method=showProfile'?>">profile</a></li>
            <li><a href="<?php echo $cont.'StudentController.php?method=logout'?>">Logout</a></li>
		      <?php } ?>


        </ul>
      </div>
  </header>

	
