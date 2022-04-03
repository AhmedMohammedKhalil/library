<?php
	ob_start();
    session_start();
	$pageTitle = 'All About us';
	include 'vars.php';
  include $tmp.'header.php';
  if(isset($_SESSION['allaboutus']))
    $aboutus = $_SESSION['allaboutus'];
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
          <div class="product" id="products" style="min-height: calc(100vh - 181.4px);padding-bottom: 50px;">
              <h1 style="text-align: center;margin:0;padding:30px;font-size:30px">All About Us</h1>
              <div class="div_button" style="display: flex;">
                    <a class="box_a" href="<?php echo $cont."AdminController.php?method=showAddAboutUs" ?>">Add About Us</a>         
              </div>
              <div class="container" style="min-height: 80px;display:flex;flex-direction:column;align-items: center;flex-wrap:wrap">
                  <?php foreach($aboutus as $a)  { ?>

                  <div class="box" style="margin-bottom: 20px ;width:50%;text-align: center;box-shadow: 0px 0px 36px rgb(0 0 0 / 24%);border-radius: 42px;overflow: hidden;">
                      <p><?php echo nl2br($a['text']) ?></p>
                        <div style="display: flex">
                            <?php   echo '<a class="box_a" href="'.$cont.'AdminController.php?method=showEditAboutUs&id='.$a['id'].'">Edit</a>' ?>
                            <?php   echo '<a href="'.$cont.'AdminController.php?method=delAboutUs&id='.$a['id'].'">Delete</a>' ?>
                        </div>
                  </div>
                  <?php }?> 
                  </div>
          </div>
        </aside>
      </section>
<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>