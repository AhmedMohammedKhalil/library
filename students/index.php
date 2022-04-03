<?php
	ob_start();
    session_start();
	$pageTitle = 'Student Profile';
	include 'vars.php';
  include $tmp.'header.php';
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
          <?php include $students.'menu.php'?>
        </aside>
        <aside class="right">
          <section class="component-details" style="padding-bottom: 0; min-height: calc(100vh - 181px)">
            <div class="details" >
            <img src="<?php if($_SESSION['student']['photo'] != NULL) {echo $imgs.'students/'.$_SESSION['student']['id'].'/'.$_SESSION['student']['photo'];} else {echo $imgs.'user-image.jpg';}?>" alt="" />
              <div class="content">
                  <h2><?php echo $_SESSION['student']['name']?></h2>
                  <h2><?php echo $_SESSION['student']['email']?></h2>
                  <h2><?php echo $_SESSION['student']['phone']?></h2>
                  <h2><?php echo $_SESSION['student']['uni_fac']?></h2>
                  <div style="display: flex">
                    <a href="<?php echo $cont.'StudentController.php?method=showSettings'?>" style="margin-right: 10px;">Edit</a>
                    <a href="<?php echo $cont.'StudentController.php?method=showChangePassword'?>">Change Password</a>
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