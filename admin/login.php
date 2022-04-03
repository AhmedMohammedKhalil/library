<?php
	ob_start();
	session_start();
	$pageTitle = 'Admin login';
	include 'vars.php';
	include $tmp.'header.php';
  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
  }
?>
  <section class="login-register" id="login">
        <div class="form">
        <div class="content">
            <h2>Admin Login</h2>
            <form action="<?php echo $cont.'AdminController.php?method=login'?>" method="POST">
              <?php
                if(isset($_SESSION['errors'])) {
                  echo '<ol style="width:fit-content;margin: 0 auto">';
                  foreach($errors as $e) {
                    echo '<li style="color: red">'.$e.'</li>';
                  }
                  echo '</ol>';
                }
              ?>
              <label for="email">Email :</label>
              <input class="input" id="email" value="<?php if(isset($_SESSION['errors'])) echo $email?>" type="email" required placeholder="Your Email" name="email" title="enter email"/>
              <label for="password">Password :</label>
              <input class="input" id="password" type="password" minlength="8" required placeholder="Your Password" name="password" title="enter password"/>
              <input class="button" name="admin_login" type="submit" value="login" />
            </form>
        </div>
        </div>
  </section>
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
  unset($_SESSION['oldData']);
  unset($_SESSION['errors']);
?>