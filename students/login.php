<?php
	ob_start();
	session_start();
	$pageTitle = 'Student login';
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
            <h2>Student Login</h2>
            <form action="<?php echo $cont.'StudentController.php?method=login'?>" method="POST">
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
              <input class="input" id="email" type="email" required placeholder="Your Email" name="email" title="enter email" 
                  value="<?php if(isset($_SESSION['errors'])) echo $email?>"/>
              <label for="password">Password :</label>
              <input class="input" id="password" type="password" required placeholder="Your Password" name="password" title="enter password"/>
              <span>If you don't have account <a href="<?php echo $cont.'StudentController.php?method=showRegister'?>">Register Now</a></span>
              <input class="button" name="student_login" type="submit" value="login" />
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