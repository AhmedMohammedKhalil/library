<?php
	ob_start();
    session_start();
	$pageTitle = 'All Sub Admins';
	include 'vars.php';
  include $tmp.'header.php';
  if(isset($_SESSION['subadmins']))
    $subadmins = $_SESSION['subadmins'];

?>
    <?php if(isset($_SESSION['msg'])) { ?>
        <p style="color:black;background:#8bfa8b;padding:20px;margin:0">
            <?php 
                echo $_SESSION['msg'] ;
                unset($_SESSION['msg']);
            ?>
        </p>
    <?php } ?>
    
    <section class="budy-content">
        <aside class="menu">
          <?php include $admin.'menu.php'?>
        </aside>
        <aside class="right">
          <div class="" style="min-height: calc(100vh - 181.4px);padding-bottom: 50px;">
              <h1 style="text-align: center;margin:0;padding:30px;font-size:30px">All Sub Admins</h1>
              <div class="div_button" style="display: flex;">
                    <a class="box_a" href="<?php echo $cont."AdminController.php?method=showAddSubAdmin" ?>">Add Sub Admin</a>         
              </div>

              <table id="lists">
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>phone</th>
                  <th>Univerisity</th>
                  <th>Control</th>


                </tr>
                <?php foreach($subadmins as $s) {?>
                    <tr>
                      <td><a href="<?php echo $cont.'AdminController.php?method=showSubAdmin&id='.$s['id'] ?>"><?php echo $s['name']?></a></td>
                      <td><?php echo $s['email']?></td>
                      <td><?php echo $s['phone']?></td>
                      <td><?php echo $s['univerisity']?></td>
                      <td style="display:flex;justify-content:center">
                        <a style="margin-right: 5px;" href="<?php echo $cont.'AdminController.php?method=showEditSubAdmin&id='.$s['id'] ?>">Edit</a>
                        <?php if(!$s['univerisity']) {?>
                          <a style="margin-right: 5px;" href="<?php echo $cont.'AdminController.php?method=delSubAdmin&id='.$s['id'] ?>">Delete</a>
                        <?php }?>
                      </td>

                    </tr>
                <?php }?>
              </table>
          </div>
        </aside>
      </section>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>