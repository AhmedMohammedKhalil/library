<?php
    ob_start();
    session_start();
    include('vars.php');
    $pageTitle = "Home";
    include($tmp.'header.php');
    include_once('layout/functions/functions.php');
    $abouts=selectAll('*','aboutus');
    $joins = 'univerisities u LEFT JOIN faculities f ON f.uni_id = u.id GROUP BY u.id';
    $unis = selectAll('u.* , count(f.id) as count', $joins);
    
?>
    <section class="landing">
        <div class="container">
          <div class="image">
              <img src="<?php echo $imgs?>landing.jpg" alt="landing image" />
          </div>
        </div>
    </section>
	  <section class="cards" id="univerisites">
        <h2 class="title">Univeristies</h2>
        <div class="container">
          <?php foreach($unis as $u) { ?> 
            <div class="box">
              <?php if($u['photo']  == null ) {?>
              <img src="<?php echo $imgs.'univeristy.png'?>" alt="univerisity photo">
              <?php }else{ ?>
              <img src="<?php echo $imgs.'univerisites/'.$u['id'].'/'.$u['photo']?>" alt="univerisity photo">
              <?php }?>
              <div class="content">
                <h3 style="text-align: center;"><?php echo $u['name']?></h3>
              </div>
              <?php if($u['count'] > 0) { ?>
              <div class="info">
                <a href="<?php echo $cont.'HomeController.php?method=showColleges&id='.$u['id']?>">View colleges</a>
              </div>
              <?php }?>
          </div>
          <?php } ?>
          
        </div>
    </section>
      <section class="about_us" id="about_us">
        <h2 class="title">About Us</h2>
        <div class="container">
          <div class="content">
          <div class="image">
              <img src="<?php echo $imgs?>about-us.png" alt="about us image" />
          </div>
            <div class="text">
              <?php 
                if(!$abouts) {
                  echo "<p>Our Goal is borrow Books</p>";
                }
                foreach($abouts as $about)
                {
                  echo "<p>".nl2br($about['text'])."</p>";
                }
              ?>
            </div>
            
          </div>
        </div>
      </section>
    
<?php
    include($tmp.'footer.php');
    ob_end_flush();

