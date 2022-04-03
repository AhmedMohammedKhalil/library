<?php
    ob_start();
    // session_start();
    include('vars.php');
    $pageTitle = "Books";
    include($tmp.'header.php');
    // include_once('layout/functions/functions.php');
    // $news=selectAll('*','aboutus');

?>
    <section class="landing landing_page">
        <div class="container">
          <div class="image land_book"></div>
          <h2 class="title">Books For college Name</h2>
        </div>
    </section>

    <div class="search">
        <form action="">
            <input type="search" placeholder="Searching ...." />
            <input type="submit" value="Search" />
        </form>
    </div>

    <section class="book" id="book">
        <div class="container">
          <div class="box" style="text-align: center;">
            <div class="image">
              <img src="assets/images/book.png" alt="book image" />
            </div>
            <h4>Title</h4>
            <h4>Subject</h4>
            <h4>Status</h4>
            <a href="/book_details.html">More</a>
          </div>
          <div class="box" style="text-align: center;">
            <div class="image">
                <img src="assets/images/book.png" alt="book image" />
            </div>
            <h4>Title</h4>
            <h4>Subject</h4>
            <h4>Status</h4>
            <a href="/book_details.html">More</a>
          </div>
          <div class="box" style="text-align: center;">
            <div class="image">
                <img src="assets/images/book.png" alt="book image" />
            </div>
            <h4>Title</h4>
            <h4>Subject</h4>
            <h4>Status</h4>
                <a href="/book_details.html">More</a>
          </div>
        </div>
      </section>

	  <?php
    include($tmp.'footer.php');
    ob_end_flush();

