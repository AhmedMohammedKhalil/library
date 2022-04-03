<?php
  ob_start();
  session_start();
	$pageTitle = 'Student Register';
	include 'vars.php';
  include $tmp."header.php";
  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
  }
?>

    <section class="login-register" id="register">
        <div class="form">
        <div class="content">
            <form action="<?php echo $cont.'StudentController.php?method=register'?>" method="POST">
              <?php
                    if(isset($_SESSION['errors'])) {
                      echo '<ol style="width:fit-content;margin: 0 auto">';
                      foreach($errors as $e) {
                        echo '<li style="color: red">'.$e.'</li>';
                      }
                      echo '</ol>';
                    }
              ?>
              <label for="name">Name :</label>
              <input class="input" id="name" type="text" required placeholder="Your Name" name="name" title="enter name" value="<?php if(isset($_SESSION['errors'])) echo $name?>"/>
              <label for="email">Email :</label>
              <input class="input" id="email" type="email" required placeholder="Your Email" name="email" title="enter email" value="<?php if(isset($_SESSION['errors'])) echo $email?>"/>
              <label for="phone">Phone :</label>
              <input class="input" id="phone" type="text" pattern="[0-9]{8}" maxlength="8" required placeholder="Your phone" name="phone" title="enter phone" value="<?php if(isset($_SESSION['errors'])) echo $phone?>"/>
              <label for="faculity">Faculity :</label>
              <select id="faculity" class="input"  title="choose faculity" name="fac_id" required > 
                <?php 
                  foreach($_SESSION['faculities'] as $f) {
                      echo "<option value='{$f['id']}'"; if(isset($_SESSION['errors']) && $f['id'] == $fac_id) {echo 'selected';} echo ">{$f['u_name']} - {$f['name']}</option>";
                  }
                ?>
              </select>
              <label for="password">Password :</label>
              <input class="input" id="password" type="password" required placeholder="Your Password" name="password" title="enter password"/>
              <label for="confirm-password">Confirm Password :</label>
              <input class="input"id="confirm-password" type="password" required placeholder="Your Password again" name="confirm_password" title="enter confirm password"/>
              <span>If you have account <a href="<?php echo $cont.'StudentController.php?method=showLogin'?>">Login Now</a></span>
              <input class="button" name="student_register" type="submit" value="Register" />
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