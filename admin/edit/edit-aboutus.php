<?php
	ob_start();
    session_start();
	$pageTitle = 'Edit About Us';
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
                    <h2>Edit About us</h2>
                    <form action="<?php echo $cont.'AdminController.php?method=editAboutUs&id='.$_SESSION['aboutus']['id']?>" method="POST" enctype="multipart/form-data">
                    <?php
                      if(isset($_SESSION['errors'])) {
                        echo '<ol style="width:fit-content;margin: 0 auto">';
                        foreach($errors as $e) {
                          echo '<li style="color: red">'.$e.'</li>';
                        }
                        echo '</ol>';
                      }
                    ?>
                        
                        <label class="label" for="text">text :</label> 
                        <textarea class="input" placeholder="text" required id="text" name="text" title="Enter text"><?php if(isset($_SESSION['errors'])){echo $text ;} else {echo $_SESSION['aboutus']['text'];}?></textarea>
                        <input class="button" name="edit_aboutus" type="submit" value="Save Changes" />
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