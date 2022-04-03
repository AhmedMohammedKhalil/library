<?php
	ob_start();
	session_start();
	$pageTitle = 'change Password';
	include 'vars.php';
	include $tmp.'header.php';
  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
  }
?>
	  <section class="budy-content">
        <aside class="menu">
          <?php include $admin.'menu.php'?>
        </aside>
        <aside class="right">
          <div class="login-register" id="login">
            <div class="form">
              <div class="content">
                  <h2>Change Password</h2>
                  <form action="<?php echo $cont.'AdminController.php?method=changePassword'?>" method="POST">
                    <?php
                      if(isset($_SESSION['errors'])) {
                        echo '<ol style="width:fit-content;margin: 0 auto">';
                        foreach($errors as $e) {
                          echo '<li style="color: red">'.$e.'</li>';
                        }
                        echo '</ol>';
                      }
                    ?>
                      <label for="password">Password :</label>
                      <input class="input" id="password" type="password" required minlength="8" placeholder="Your Password" name="password" title="enter password" />
                      <label for="confirm_password">Confirm Password :</label>
                      <input class="input"id="confirm_password" type="password" minlength="8" placeholder="Your Password again" name="confirm_password" title="enter confirm password"/>
                    <input class="button" type="submit" name="change_password" value="Change Password" />
                  </form>
              </div>
            </div>
          </div>
        </aside>
    </section>
    
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
    unset($_SESSION['errors']);
?>