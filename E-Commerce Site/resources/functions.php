<?php

//helper functions 

function redirect($location){

	header("Location: $location");
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

    


//BACK END FUNCTIONS


?>