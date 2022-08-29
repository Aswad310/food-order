<?php include("partials-front/menu.php"); ?>

    <!-- food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php   
                //Get the Search Keyword
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                // 1. Query
                $sql = "SELECT *FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                // 2. execute query 
                $res = mysqli_query($conn, $sql) or die('error'.mysqli_error($conn));
                // 3. check whether query executed or not
                if($res == true)
                {
                    // count rows
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        // data present
                        while($rows = mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $description = $rows['description'];
                            $price = $rows['price'];
                            $image_name = $rows['image_name']; 

                            ?> <!-- PHP Break -->
                            
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                <?php 
                                    if($image_name == "")
                                    {
                                         // no picture
                                         echo "<div class='failure'>No Picture!</div>";
                                    }
                                    else
                                    {   ?> <!-- PHP Breaks -->
                                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php //<!-- PHP Starts -->
                                    }
                                ?>
                                </div>
                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                            <?php //<!-- PHP Starts -->
                        }
                    }
                    else
                    {
                        //Food Not Available
                        echo "<div class='failure'>Food not found.</div>";
                    }
                }  
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("partials-front/footer.php"); ?>