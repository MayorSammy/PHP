<?php

//helper functions 

function redirect($location){

	header("Location: {$location}");
}

function set_message($message){
    if(!empty($message)){
        $_SESSION['message'] = $message;
    }
    else{
        $message = "";
    }


}

function display_message(){
    $message = $_SESSION['message'];
    if (isset($message)) {
        echo $message;
        unset($_SESSION["message"]);
    }

}


function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result){
	if (!$result) {
		die("QUERY FAILED: ".mysqli_error($connection));
	}
}

function escape_string($sql){
	global $connection;
	return mysqli_real_escape_string($connection,$sql);
}

function fetch_array($result){

	return mysqli_fetch_assoc($result);
}


//FRONT END FUNCTIONS

//get products
function get_products(){
	$query = query("SELECT * FROM products");
	//confirm($query);
	


	while ($row= fetch_array($query)) {
		//HEREDOC

		$product = <<<MARKER
		<div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href= "item.php?id={$row["product_id"]}""><img src="{$row["product_image"]}" alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right">\${$row["product_price"]}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row["product_title"]}</a>
                                </h4>
                                <p>{$row['short_desc']}</p>
                                <a class="btn btn-primary" target="_blank" href="item.php?id={$row["product_id"]}">Add to cart</a>

                            </div>

                            

                        </div>
                    </div>
MARKER;
echo($product);
	}
}


function get_categories(){
	$query = query("SELECT * FROM categories");
    confirm($query);
            
            while ($row = fetch_array($query)) {

                $categories = <<<MARKER
                <a href='category.php?id={$row["cat_id"]}' class='list-group-item'>{$row['cat_title']}</a>
                MARKER;
                echo($categories);
            }
}


function get_category_products(){
	$query = query("SELECT * FROM products WHERE product_category_id = ". escape_string($_GET['id']));
	confirm($query);

	while ($row = fetch_array($query)) {
		$category_products = <<<MARKER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src= {$row['product_image']} alt="">
                    <div class="caption">
                        <h3>Feature {$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            MARKER;

            echo($category_products);
        }
    }


/////////////////////////

function get_shop_products(){
	$query = query("SELECT * FROM products");
	confirm($query);

	while ($row = fetch_array($query)) {
		$all_products = <<<MARKER
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src= {$row['product_image']} alt="">
                    <div class="caption">
                        <h3>Feature {$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            MARKER;

            echo($all_products);
        }
    }


function login_user(){
    if (isset($_POST['submit'])) {


        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = {$username} AND password = {$password}");
        confirm($query);

        if(mysqli_num_rows($query)==0){
            set_message("Your Password or Username is incorrect");
            redirect("login.php");
        }
        else{
            redirect("admin");
        }
    }
}


function send_message(){

    if (isset($_POST["submit"])) {

        $receiver = "samuelebong20@gmail.com";
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];


        $header = "FROM: {$name} ({$email})";

        $sent = mail($receiver, $subject , $message, $header);

        if (!$sent) {
            set_message("We experienced an issue while trying to send your email");
            redirect("contact.php");
        }
        else{
            set_message("Message successfully sent");
            redirect("contact.php");
        }
    }

    
}

    


//BACK END FUNCTIONS


?>