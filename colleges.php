<?php
    ob_start();
    session_start();
    include('vars.php');
    $pageTitle = "Colleges";
    include($tmp.'header.php');

?>
     <section class="landing landing_page ">
        <div class="container">
          <div class="image land_college"></div>
          <h2 class="title">Colleges</h2>
        </div>
    </section>

	  <section class="cards" id="colleges" >
        <div class="container">
        <?php foreach($_SESSION['faculities'] as $f) {?> 
            <div class="box">
              <?php if($f['photo']  == null ) {?>
              <img src="<?php echo $imgs.'faculity.jpg'?>" alt="faculty photo">
              <?php }else{ ?>
              <img src="<?php echo $imgs.'faculities/'.$f['id'].'/'.$f['photo']?>" alt="faculty photo">
              <?php }?>
              <div class="content">
                <h3 style="text-align: center;"><?php echo $f['name']?></h3>
              </div>
              <?php if($f['count'] > 0) { ?>
              <div class="info">
                <a href="<?php echo $cont.'HomeController.php?method=showBooks&id='.$f['id']?>">View Books</a>
              </div>
              <?php }?>
            </div>
        <?php }?>
        </div>
      </section>

    
<?php
    include($tmp.'footer.php');
    ob_end_flush();

