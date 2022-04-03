<?php
	ob_start();
    session_start();
	$pageTitle = 'Students Dashboard';
	include 'init.php';
    include $tmp.'header.php';
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
          <ul>
            <li><a href="">Dashboard</a></li>
            <li><a href="">Profile</a></li>
            <li><a href="">Settings</a></li>
            <li><a href="">Change Passsword</a></li>
            <li><a href="">Logout</a></li>
          </ul>
        </aside>
        <aside class="right">
          <section style="padding-bottom: 50px; min-height: calc(100vh - 181px)">
            <div class="stats" id="stats">
              <h2>My Dashboard</h2>
              <div class="container">
                <div class="box">
                  <span class="number">10</span>
                  <a href="products.html"><span class="text">Books</span></a>
                </div>
                <div class="box">
                  <span class="number">10</span>
                  <a href="orders.html"><span class="text">Booking Book</span></a>
                </div>
                <div class="box">
                  <span class="number">10</span>
                  <a href="orders.html"><span class="text">Orders</span></a>
                </div>
              </div>
            </div>
          </section>
        </aside>
      </section>

<?php
	include $tmp . 'footer.php'; 
	ob_end_flush();

?>