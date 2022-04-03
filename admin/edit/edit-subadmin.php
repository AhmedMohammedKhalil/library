<?php
	ob_start();
    session_start();
    $pageTitle = 'Edit Sub Admin';
    include 'vars.php';
    include $tmp.'header.php';
    if(isset($_SESSION['errors'])) {
      $errors = $_SESSION['errors'];
      $oldData = $_SESSION['oldData'];
      extract($oldData);
    }
?>
   
    
    <section class="budy-content">
        <aside class="menu">
          <?php include $admin.'menu.php'?>
        </aside>
        <aside class="right">
          <div class="login-register" id="register">
              <div class="form">
                <div class="content">
                    <h2>Edit Sub Admin</h2>
                    <form action="<?php echo $cont.'AdminController.php?method=editSubAdmin&id='.$_SESSION['subadmin']['id']?>" method="POST" enctype="multipart/form-data">
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
                        <input class="input" title="enter name" type="text" placeholder="Your Name" name="name" id="name" required  value="<?php if(isset($_SESSION['errors'])) {echo $name; } else {echo $_SESSION['subadmin']['name'];}?>"/>
                        <label class="label" for="email">Email :</label>
                        <input class="input" title="enter email" type="email" placeholder="Your Email" name="email" id="email" required value="<?php if(isset($_SESSION['errors'])) {echo $email; } else {echo $_SESSION['subadmin']['email'];}?>" />
                        <span>If you don't change Password, leave them empty</span>
                        <label for="password">Password :</label>
                        <input class="input" id="password" type="password"  minlength="8" placeholder="Your Password" name="password" title="enter password" />
                        <label for="confirm_password">Confirm Password :</label>
                        <input class="input" id="confirm_password" type="password"  minlength="8" placeholder="Your Password again" name="confirm_password" title="enter confirm password"/>
                        <input class="button" name="edit_subadmin" type="submit" value="Save Changes" />
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