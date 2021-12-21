<?php include_once("../resources/config.php");?>
<?php include_once(TEMPLATE_FRONT.DS."header.php");?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Your Journey to feeling The Sound starts now...</h1>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Product -->
            <div class="row text-center">
            
            <?php 
            
            get_shop_products();
                
            
            ?>


            

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <?php include_once(TEMPLATE_FRONT.DS."footer.php");?>
   