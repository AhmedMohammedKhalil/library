<?php
	ob_start();
    session_start();
	$pageTitle = 'Add Faculty';
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
                    <h2>Add Faculty</h2>
                    <form action="<?php echo $cont.'AdminController.php?method=addFaculity'?>" method="POST" enctype="multipart/form-data">
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
                        <input id="name" class="input" type="text" placeholder="Faculty Name" title="Enter Faculty Name" id="name" name="name" required value="<?php if(isset($_SESSION['errors'])){echo $name ;}?>" />
                        <label class="label" for="Univerisity">Univerisity :</label>
                        <select id="Univerisity" class="input"  title="choose Univerisity" name="uni_id" required > 
                          <?php 
                            foreach($_SESSION['uni'] as $u) {
                               echo "<option value='{$u['id']}'"; if(isset($_SESSION['errors']) && $u['id'] == $uni_id) {echo 'selected';} echo ">{$u['name']}</option>";
                            }
                          ?>
                        </select>
                        <label class="label" for="description">Description :</label> 
                        <textarea class="input" placeholder="Description" required id="description" name="description" title="Enter Faculty Description"><?php if(isset($_SESSION['errors'])){echo $description ;}?></textarea>
                        <input class="button" name="add_faculty" type="submit" value="Add" />
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