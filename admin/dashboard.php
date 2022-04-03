<?php
	ob_start();
	session_start();
	$pageTitle = 'Dashboard';
	include 'vars.php';
	include $tmp.'header.php';
  if(isset($_SESSION['dashboardcount'])) {
    extract($_SESSION['dashboardcount']);
  }
?>
  <?php if(isset($_SESSION['msg'])) { ?>
        <p style="color:black;background:#8bfa8b;padding:20px;margin:0">
            <?php 
                echo $_SESSION['msg'] ;
                unset($_SESSION['msg']);
            ?>
        </p>
  <?php } ?>

  <section class="budy-content">
        <aside class="menu">
          <?php include $admin.'menu.php'?>
        </aside>
        <aside class="right">
          <section style="padding-bottom: 50px; min-height: calc(100vh - 181px)">
            <div class="stats" id="stats">
              <h2><?php echo ucfirst($_SESSION['auth'])?> Dashboard</h2>
              <div class="container">
                <?php if($_SESSION['auth'] == 'admin') {?>
                  <div class="box">
                    <span class="number"><?php echo $subadmin_count?></span>
                    <a href="<?php echo $cont.'AdminController.php?method=showSubAdmins'?>"><span class="text">Sub Admins</span></a>
                  </div>
                  <div class="box">
                    <span class="number"><?php echo $aboutus_count?></span>
                    <a href="<?php echo $cont.'AdminController.php?method=showAboutUs'?>"><span class="text">About Us</span></a>
                  </div>
                  <div class="box">
                    <span class="number"><?php echo $univerisities_count?></span>
                    <a href="<?php echo $cont.'AdminController.php?method=showUniverisities'?>"><span class="text">Univerisities</span></a>
                  </div>
                  <div class="box">
                    <span class="number"><?php echo $orders_count?></span>
                    <a href="<?php echo $cont.'AdminController.php?method=showOrders'?>"><span class="text">Orders</span></a>
                  </div>
                <?php }?>
                <div class="box">
                  <span class="number" ><?php echo $faculities_count?></span>
                  <a href="<?php echo $cont.'AdminController.php?method=showAllFaculities'?>"><span class="text">Faculities</span></a>
                </div>
                
                <div class="box">
                  <span class="number"><?php echo $books_count?></span>
                  <a href="<?php echo $cont.'AdminController.php?method=showAllBooks'?>"><span class="text">Books</span></a>
                </div>
                <div class="box">
                  <span class="number"><?php echo $students_count?></span>
                  <a href="<?php echo $cont.'AdminController.php?method=showStudents'?>"><span class="text">Students</span></a>
                </div>
              </div>
            </div>
          </section>
        </aside>
      </section>
	<?php
	include $tmp . 'footer.php';
	ob_end_flush();
?>