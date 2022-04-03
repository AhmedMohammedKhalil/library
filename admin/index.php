<?php
	ob_start();
    session_start();
	$pageTitle = 'Profile';
	include 'vars.php';
  include $tmp.'header.php';
  if($_SESSION['auth'] == 'admin')
    $auth = $_SESSION['admin'];
  else
    $auth = $_SESSION['sub_admin'];

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
          <section class="component-details" style="padding-bottom: 0; min-height: calc(100vh - 181px)">
            <div class="details" >
              <img src="<?php if($auth['photo'] != NULL) {echo $imgs.'admins/'.$auth['id'].'/'.$auth['photo'];} else {echo $imgs.'user-image.jpg';}?>" alt="" />
              <div class="content">
                  <?php 
                    echo "<h2>{$auth['name']}</h2>";
                    echo "<h2>{$auth['email']}</h2>";
                    echo "<h2>{$auth['phone']}</h2>";
                  ?>
                  <div style="display: flex">
                    <a href="<?php echo $cont.'AdminController.php?method=showSettings'?>" style="margin-right: 10px;">Edit</a>
                    <a href="<?php echo $cont.'AdminController.php?method=showChangePassword'?>">Change Password</a>
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