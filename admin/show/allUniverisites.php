<?php
	ob_start();
    session_start();
	$pageTitle = 'All Univerisities';
	include 'vars.php';
  include $tmp.'header.php';
  if(isset($_SESSION['univerisities']))
    $unis = $_SESSION['univerisities'];
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
              <h1 style="text-align: center;margin:0;padding:30px;font-size:30px">All Univerisities</h1>
              <div class="div_button" style="display: flex;">
                    <a class="box_a" href="<?php echo $cont."AdminController.php?method=showAddUniverisity" ?>">Add Univerisity</a>         
              </div>
              <div class="container" style="min-height: 80px;display:flex;justify-content:space-around;flex-wrap:wrap">
                  <?php foreach($unis as $u)  { ?>

                  <div class="box" style="margin-bottom: 20px ;text-align: center;box-shadow: 0px 0px 36px rgb(0 0 0 / 24%);border-radius: 42px;overflow: hidden;">
                      <div class="image" style="height:286px;width:500px">
                          <?php if($u['photo']  == null ) {?>
                          <img src="<?php echo $imgs.'univeristy.png'?>" alt="univerisity photo" style="width: 100%;height:100%">
                          <?php }else{ ?>
                          <img src="<?php echo $imgs.'univerisites/'.$u['id'].'/'.$u['photo']?>" alt="univerisity photo" style="width: 100%;height:100%">
                          <?php }?>
                      </div>
                      <h4><?php echo $u['name'] ?></h4>
                      <h4><?php echo $u['sub_admin'] ?></h4>
                      <p><?php echo nl2br($u['address']) ?></p>
                      <p><?php echo nl2br($u['description']) ?></p>

                      <div style="display: flex">
                          <?php /*  if($u['count'] != 0) echo '<a href="'.$cont.'AdminController.php?method=showFaculity&id='.$u['id'].'">Show Faculities</a>' */?>
                          <?php   echo '<a href="'.$cont.'AdminController.php?method=showEditUniverisity&id='.$u['id'].'">Edit</a>' ?>
                          <?php   if($u['count'] == 0) echo '<a href="'.$cont.'AdminController.php?method=delUniverisity&id='.$u['id'].'">Delete</a>' ?>
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