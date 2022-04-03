<?php
    ob_start();
    // session_start();
    include('vars.php');
    $pageTitle = "Book Details";
    include($tmp.'header.php');
    // include_once('layout/functions/functions.php');
    // $news=selectAll('*','aboutus');

?>
    <section class="landing landing_page">
        <div class="container">
          <div class="image land_book"></div>
          <h2 class="title">Book Details about Book Name</h2>
        </div>
    </section>

    

    <section class="component-details" id="book">
        <div class="details">
          <img src="assets/images/book.png" alt="book image" />
          <div class="content">
              <h2>Title</h2>
              <h2>Owner Name</h2>
              <h2>Subject</h2>
              <h2>Faculity - Univerisity</h2>
              <h2>Status</h2>
              <h2>Free or Paid (25 KD)</h2>
              <p>Details</p>
              <a href="#">Booking</a>
          </div>
        </div>
    </section>

<?php
    include($tmp.'footer.php');
    ob_end_flush();

