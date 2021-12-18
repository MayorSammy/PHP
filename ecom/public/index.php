<?php include_once("../resources/config.php");?>
<?php include_once(TEMPLATE_FRONT.DS."header.php");?>


    <!-- Page Content -->
    <div class="container">

        <!--Side Navigation here-->
        <div class="row">
            <?php include_once(TEMPLATE_FRONT.DS."side_nav.php");?>
            

            <div class="col-md-9">

                <!--carousel slider here-->
                <?php include_once(TEMPLATE_FRONT.DS."slider.php");?>

                <!-- product display -->
                <div class="row">

                    <?php get_products(); ?>

                    
                    

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <h4><a href="#">Have a Question to ask?</a>
                        </h4>
                        <p>Click below to chat with one of our lovely representatives <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">Start Chat :)</a> </p>
                        <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">Start Chat :)</a>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <?php include_once(TEMPLATE_FRONT.DS."footer.php");?>