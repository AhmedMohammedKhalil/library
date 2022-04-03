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
?>
    <section class="budy-content">
        <aside class="menu">
          <?php include $students.'menu.php'?>
        </aside>
        <aside class="right">
          <div class="login-register" id="register">
            <div class="form">
              <div class="content">
                  <h2>settings</h2>
                  <form action="<?php echo $cont.'StudentController.php?method=editProfile'?>" method="POST" enctype="multipart/form-data">
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
                    <input class="input" id="name" type="text" required placeholder="Your Name" name="name" title="enter name" value="<?php if(isset($_SESSION['errors'])){echo $name;}else{echo $_SESSION['student']['name'];}?>"/>
                    <label for="email">Email :</label>
                    <input class="input" id="email" type="email" required placeholder="Your Email" name="email" title="enter email" value="<?php if(isset($_SESSION['errors'])) {echo $email;}else{echo $_SESSION['student']['email'];}?>"/>
                    <label for="phone">Phone :</label>
                    <input class="input" id="phone" type="text" pattern="[0-9]{8}" maxlength="8" required placeholder="Your phone" name="phone" title="enter phone" value="<?php if(isset($_SESSION['errors'])) {echo $phone;}else{echo $_SESSION['student']['phone'];}?>"/>
                    <label for="faculity">Faculity :</label>
                    <select id="faculity" class="input"  title="choose faculity" name="fac_id" required > 
                      <?php 
                        foreach($_SESSION['faculities'] as $f) {
                            echo "<option value='{$f['id']}'"; if(isset($_SESSION['errors']) && $f['id'] == $fac_id) {echo 'selected';} elseif($_SESSION['student']['fac_id'] == $f['id']){echo 'selected';} echo ">{$f['u_name']} - {$f['name']}</option>";
                        }
                      ?>
                    </select>
                    <label class="label" for="photo">Photo :</label>
                    <input type="file" class="input"   title="upload photo" name="photo" id="photo" accept="image/jpg,image/jpeg,image/png"/>
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