<?php
	ob_start();
	session_start();
	$pageTitle = 'Settings';
	include 'vars.php';
	include $tmp.'header.php';
  if(isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $oldData = $_SESSION['oldData'];
    extract($oldData);
  }
  if($_SESSION['auth'] == 'admin')
    $auth = $_SESSION['admin'];
  else
    $auth = $_SESSION['sub_admin'];
?>
    <section class="budy-content">
        <aside class="menu">
          <?php include $admin.'menu.php'?>
        </aside>
        <aside class="right">
          <div class="login-register" id="register">
            <div class="form">
              <div class="content">
                  <h2>settings</h2>
                  <form action="<?php echo $cont.'AdminController.php?method=editProfile'?>" method="POST" enctype="multipart/form-data">
                  <?php
                      if(isset($_SESSION['errors'])) {
                        echo '<ol style="width:fit-content;margin: 0 auto">';
                        foreach($errors as $e) {
                          echo '<li style="color: red">'.$e.'</li>';
                        }
                        echo '</ol>';
                      }
                    ?>
                      <label class="label" for="name">Name :</label>
                      <input class="input" title="enter name" type="text" placeholder="Your Name" name="name" id="name" required  value="<?php if(isset($_SESSION['errors'])) {echo $name; } else { echo $auth['name'];}?>"/>
                      <label class="label" for="email">Email :</label>
                      <input class="input" title="enter email" type="email" placeholder="Your Email" name="email" id="email" required value="<?php if(isset($_SESSION['errors'])) {echo $email; } else { echo $auth['email'];}?>" />
                      <label class="label" for="photo">Photo :</label>
                      <input type="file" class="input"   title="upload photo" name="photo" id="photo" accept="image/jpg,image/jpeg,image/png"/>
                      <label class="label" for="phone">Phone :</label>
                      <input class="input" title="enter phone number" pattern="[0-9]{8}" maxlength="8" type="text" placeholder="Your phone" name="phone" id="phone" required  value="<?php if(isset($_SESSION['errors'])) {echo $phone; } else { echo $auth['phone'];}?>"/>
                      <input class="button" name="edit_profile" type="submit" value="Save Changes" />
                  </form>
              </div>
            </div>
          </div>
        </aside>
    </section>
<?php
	include $tmp . 'footer.php';
	ob_end_flush();
    unset($_SESSION['oldData']);
    unset($_SESSION['errors']);
?>