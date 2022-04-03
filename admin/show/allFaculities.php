<?php
	ob_start();
    session_start();
	$pageTitle = 'All Faculities';
	include 'vars.php';
  include $tmp.'header.php';
  if(isset($_SESSION['faculities']))
    $facs = $_SESSION['faculities'];
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
              <h1 style="text-align: center;margin:0;padding:30px;font-size:30px">All Faculities</h1>
              <?php if($_SESSION['auth'] == 'admin') { ?>
              <div class="div_button" style="display: flex;">
                    <a class="box_a" href="<?php echo $cont."AdminController.php?method=showAddFaculity" ?>">Add Faculity</a>         
              </div>
              <?php } ?>
              <div class="container" style="min-height: 80px;display:flex;justify-content:space-around;flex-wrap:wrap">
                  <?php foreach($facs as $f)  { ?>

                  <div class="box" style="margin-bottom: 20px ;text-align: center;box-shadow: 0px 0px 36px rgb(0 0 0 / 24%);border-radius: 42px;overflow: hidden;">
                      <div class="image" style="height:286px;width:500px">
                          <?php if($f['photo']  == null ) {?>
                          <img src="<?php echo $imgs.'faculity.jpg'?>" alt="Faculity photo" style="width: 100%;height:100%">
                          <?php }else{ ?>
                          <img src="<?php echo $imgs.'faculities/'.$f['id'].'/'.$f['photo']?>" alt="Faculity photo" style="width: 100%;height:100%">
                          <?php }?>
                      </div>
                      <h4><?php echo $f['name'] ?></h4>
                      <h4><?php echo $f['univerisity_name'] ?></h4>
                      <p><?php echo nl2br($f['description']) ?></p>
                      <?php if($_SESSION['auth'] == 'admin') { ?>
                        <div style="display: flex">
                            <?php   echo '<a href="'.$cont.'AdminController.php?method=showEditFaculity&id='.$f['id'].'">Edit</a>' ?>
                            <?php   if($f['count'] == 0) echo '<a href="'.$cont.'AdminController.php?method=delFaculity&id='.$f['id'].'">Delete</a>' ?>
                        </div>
                      <?php }?>
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