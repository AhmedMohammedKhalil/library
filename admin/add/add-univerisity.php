<?php
	ob_start();
    session_start();
	$pageTitle = 'Add Univerisity';
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
                    <h2>Add Univerisity</h2>
                    <form action="<?php echo $cont.'AdminController.php?method=addUniverisity'?>" method="POST" enctype="multipart/form-data">
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
                        <input id="name" class="input" type="text" placeholder="Univerisity Name" title="Enter Univerisity Name" id="name" name="name" required value="<?php if(isset($_SESSION['errors'])){echo $name ;}?>" />
                        <label class="label" for="subadmin">Sub Admin :</label>
                        <select id="subadmin" class="input"  title="choose Sub Admin" name="subadmin_id" required > 
                          <?php 
                            foreach($_SESSION['subadmins'] as $s) {
                               echo "<option value='{$s['id']}'"; if(isset($_SESSION['errors']) && $s['id'] == $sub_admin_id) {echo 'selected';} echo ">{$s['name']}</option>";
                            }
                          ?>
                        </select>
                        <label class="label" for="address">Address :</label>              
                        <textarea class="input" placeholder="Univerisity Address" required id="address" name="address" title="Enter Univerisity Address"><?php if(isset($_SESSION['errors'])){echo $address ;}?></textarea>
                        <label class="label" for="description">Description :</label> 
                        <textarea class="input" placeholder="Description" required id="description" name="description" title="Enter Univerisity Description"><?php if(isset($_SESSION['errors'])){echo $description ;}?></textarea>
                        <input class="button" name="add_univerisity" type="submit" value="Add" />
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