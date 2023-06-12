<?php
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');
    session_start();
    if(!isset($_SESSION['user_name'])){
        header('Location: signin.php');
        
    }else{
        $user_id=$_SESSION['user_id'];
    }
    include "./cart.php"
?>
<?php
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');  
    if(isset($_POST['add_to_cart'])){
            $pid=$_POST['pid'];
            $check_cart_numbers= $conn->prepare("SELECT * FROM cart where id=?");
            $check_cart_numbers->execute([$pid]);
            if($check_cart_numbers->rowCount()>0) {
                $message = 'already added to card!';
            }else{
                $insert_cart= $conn->prepare("INSERT INTO cart SELECT * FROM products pr where pr.id=?");
                $insert_cart->execute([$pid]);
                $message = 'added to card!';
            }
        }
?>
<?php 
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');    
    if(isset($_POST['del_from_cart'])){
            $pid=$_POST['pid'];
            $del_cart= $conn->prepare("DELETE FROM cart where id=?");
            $del_cart->execute([$pid]);
            
        }
?>
<?php 
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');    
    if(isset($_POST['del_from_cart'])){
            $pid=$_POST['pid'];
            $del_cart= $conn->prepare("DELETE FROM cart where id=?");
            $del_cart->execute([$pid]);
            
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop PArtitions</title>
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- css file link -->
    <link rel="stylesheet" href="./assets/CSS/styles.css">
</head>
<body>
    <!-- Header section start -->
    <header class="header">
        <a href="#home" class="logo"><img src="./assets/Images/laptop-partitions-high-resolution-logo-color-on-transparent-background (1).png" alt=""></a>
        <!-- <a href="#" class="logo"><i class="fas fa-shopping-basket"></i> Laptop partitions</a> -->
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#features">features</a>
            <a href="#products">products</a>
            <a href="#reviews">reviews</a>
            <a href="#Contact Us">contact us</a>
        </nav>
        <div class="icons">
            <?php 
                $count_card_items = $conn->prepare("select * from cart ");
                $count_card_items -> execute();
                $total_card_items = $count_card_items->rowCount();
            ?>
            <div class="fas fa-bars" id="menu-btn"></div>
            <div class="fas fa-search" id="search-btn"></div>
            <div class="fas fa-shopping-cart" id="cart-btn"><span>(<?=$total_card_items; ?>)</span></div>
            <div class="fas fa-user" id="login-btn"></div>
        </div>
        <!-- Container de recherche -->
        <div class="search-form">
        <!-- formulaire de recherche -->
    <form action="" class="form" method="post">
        <input type="search" id="search-box" placeholder="search ..." required name="search_box"  value="<?php echo isset($_POST['search_box']) ? $_POST['search_box'] : '' ?>">
        <button type="submit" class="fas fa-search" name="search_btn"></button>
    </form>
    <?php
        if(isset($_POST['search_btn'])){
        $search_box=$_POST['search_box'];
        $select_products= $conn->prepare("SELECT * FROM products where product_name LIKE '%{$search_box}%'");
        $select_products->execute();
        if($select_products->rowCount()>0) { ?>
            <div class="boxx-container">
            <?php while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ ?>
                <div class="boxx">
                <img src="<?= $fetch_products['image_path']?>" alt="">
                <h3><?= $fetch_products['product_name']?></h3>
                <div class="price">$<?=$fetch_products['product_price']?></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                </div>
            <?php } ?>
            </div>
        <?php } else { 
            echo '<p class="notfound">No products found!</p>';
        } 
        } 

        // Si le champ de recherche est rempli, on affiche le formulaire de recherche
        if(isset($_POST['search_box'])) { ?>
        <script>
            document.querySelector(".search-form").classList.add('active');
        </script>
        <?php } ?>
    </div>



    <div class="shopping-cart">
            <!-- ---------Products in cart -->
            <?php
            $cart_products= $conn->prepare("SELECT * FROM cart");
            $cart_products->execute();
            if($cart_products->rowCount()>0) { ?>
                <div class="boxx-container">
                <?php while($fetch_products = $cart_products->fetch(PDO::FETCH_ASSOC)){ ?>
                    <div class="boxx">
                    <form action="user_page.php" method="post">
                        
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']?>">
                        <img src="<?= $fetch_products['image_path']?>" alt="">
                        <h3><?= $fetch_products['product_name']?></h3>
                        <div class="price">$<?= number_format($fetch_products['product_price'], 2) ?></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <div class="flex-btn">
                            <input type="number" min="1" value="1" class="qty" name="p_qty">
                            <input type="submit" value="Delete from cart" name="del_from_cart" class="del_btn">
                        </div>
                    </form>
                    </div>
                <?php } ?>
                    
                </div>
                <hr>
                <hr>
                <form action="payement.php" method="post" target="_blank">
                    <div class="checkout-btn-container">
                        <input type="submit" name="check-btn" value="CheckOut" class="check_btn">
                    </div>
                </form>
                
            <?php } else { 
            echo '<p class="notfound">No products in Cart!</p>';
        } 

        // Si lon supprime un elem, on affiche le cart a nouveau
        if(isset($_POST['del_from_cart'])){ ?>
        <script>
            document.querySelector(".shopping-cart").classList.add('active');
        </script>
        <?php } ?>
            
        </div>


        <form action="" class="login-form">
            <ion-icon name="person-circle-outline"></ion-icon>
            <h3>Hi <span class="user_name"><?php 
                echo $_SESSION['user_name'];
            ?> </span> !</h3>
            <p>We hope you're enjoying your shopping</p>
            <a href="logout.php" onclick="return confirm ('logout from this website?');" id="logout">Log out</a>
            <a href="update.php"  id="update" target="_blank">Update my account</a>
            <p id="upd">Log out to update your data.</p>
        </form>
    </header>
    <!-- Header section end -->
    <!-- Home section start -->
    <section class="home" id="home">
        <div class="content">
            <h3><span>best</span> prices and <span>high </span>quality</h3>
            <p>Why not buy directly from the wholesaler, without intermediaries, at top prices? We are <span>laptop partitions </span>dealer and distributor of many notebook manufacturers for many years. And the best 3/4 of the orders are shipped to you on the same day.</p>
            <a href="#products" class="btn">shop now!</a>
        </div>
    </section>
    <!-- Home section end -->
    <!-- Features section start -->
    <section class="features" id="features">
        <h1 class="heading">our <span>features</span></h1>
        <div class="card-group">
            <div class="card">
                <img src="./assets/Images/—Pngtree—best seller product iconic_7512832.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">quality guarantee</h3>
                    <p class="card-text"> You can trust in the quality of our laptop partitions! We stand behind every product we sell with our Quality Guarantee, so you can shop with confidence knowing that you're getting a high-quality product that meets your expectations.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            <div class="card">
                <img src="./assets/Images/Delivery-cuate.svg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">free delivery</h3>
                    <p class="card-text">No need to worry about extra shipping costs - we've got you covered! Enjoy free delivery on all orders, and get your laptop partitions delivered right to your doorstep without any hassle or extra fees. Shop now and take advantage of this great offer!</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
            <div class="card">
                <img src="./assets/Images/Credit Card Payment-cuate.svg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="card-title">easy payments</h3>
                    <p class="card-text">Pay the way you want, when you want! We offer flexible payment options that fit your lifestyle and budget. Shop with ease and convenience knowing that you can choose the payment method that works best for you.</p>
                    <a href="#" class="btn">read more</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->
    <!-- Products section start -->
    <section class="product" id="products">
        <h1 class="heading"> our <span>products</span></h1>
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                        <input type="hidden" name="pid" value="1">
                        <img src="./assets/Images/produits/1-1.jpg" alt="">                    
                        <h3>hp omen 17</h3>
                        <div class="price">$1999.99</div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                        <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 1) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="2">
                    <img src="./assets/Images/produits/2-2.jpg" alt="">                    
                    <h3>azus ROG strix</h3>
                    <div class="price">$1999.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 2) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="3" >
                    <img src="./assets/Images/produits/3-3.jpg" alt="">                    
                    <h3>MSI pulse 15</h3>
                    <div class="price">$1999.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 3) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="4" >
                    <img src="./assets/Images/produits/22.jpg" alt="">                    
                    <h3>Apple 16" mackbook pro</h3>
                    <div class="price">$3249.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 4) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="5">
                    <img src="./assets/Images/produits/1.webp" alt="">                    
                    <h3>supermicro MBD</h3>
                    <div class="price">$717.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 5) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- -------------- -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="6" >
                    <img src="./assets/Images/produits/2.webp" alt="">                    
                    <h3>supermicro MBD-X</h3>
                    <div class="price">$802.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 6) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="7" >
                    <img src="./assets/Images/produits/3.jpg" alt="">                    
                    <h3>INTEL XEON CPU</h3>
                    <div class="price">$930.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 7) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="8">
                    <img src="./assets/Images/produits/4.jpg" alt="">                    
                    <h3>INTEL SSD D3-S4</h3>
                    <div class="price">$368.75</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 8) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="9" >
                    <img src="./assets/Images/produits/5.jpg" alt="">                    
                    <h3>INTEL SSD DC-P4</h3>
                    <div class="price">$950.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 9) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="10" >
                    <img src="./assets/Images/produits/27.jpg" alt="">                    
                    <h3>AMD Ryzen 9</h3>
                    <div class="price">$699.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 10) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- ------------ -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="11" >
                    <img src="./assets/Images/produits/6.jpg" alt="">                    
                    <h3>HPE P2</h3>
                    <div class="price">$339.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 11) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="12">
                    <img src="./assets/Images/produits/7.jpg" alt="">                    
                    <h3>seagate exos</h3>
                    <div class="price">$168.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 12) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="13" >
                    <img src="./assets/Images/produits/26.jpg" alt="">                    
                    <h3>intel core i9-13900K</h3>
                    <div class="price">$569.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 13) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="14">
                    <img src="./assets/Images/produits/8.jpg" alt="">                    
                    <h3>32G DDR4</h3>
                    <div class="price">$50.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 14) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="15">
                    <img src="./assets/Images/produits/9.jpg" alt="">                    
                    <h3>Lenovo 4ZC7</h3>
                    <div class="price">$78.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 15) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- ------------ -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="16" >
                    <img src="./assets/Images/produits/10.jpg" alt="">                    
                    <h3>DELL battery</h3>
                    <div class="price">$59.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 16) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="17" >
                    <img src="./assets/Images/produits/11.jpg" alt="">                    
                    <h3>macBook air battery</h3>
                    <div class="price">$59.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 17) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="18">
                    <img src="./assets/Images/produits/24.jpg" alt="">                    
                    <h3>BTI 6-Cell battery</h3>
                    <div class="price">$92.26</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 18) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="19" >
                    <img src="./assets/Images/produits/12.jpg" alt="">                    
                    <h3>NVIDIA QUADRO 8G</h3>
                    <div class="price">$360.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 19) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="20">
                    <img src="./assets/Images/produits/13.jpg" alt="">                    
                    <h3>CMP 70HX</h3>
                    <div class="price">$350.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 20) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- ------------ -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="21" >
                    <img src="./assets/Images/produits/14.jpg" alt="">                    
                    <h3>Laptop LCD Screen FHD 1920×1080</h3>
                    <div class="price">$109.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 21) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="22">
                    <img src="./assets/Images/produits/15.jpg" alt="">                    
                    <h3>Laptop LCD Screen FHD 1920×1080</h3>
                    <div class="price">$113.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 22) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="23" >
                    <img src="./assets/Images/produits/16.jpg" alt="">                    
                    <h3>Logitch MX keyboard</h3>
                    <div class="price">$119.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 23) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="24">
                    <img src="./assets/Images/produits/17.jpg" alt="">                    
                    <h3>Logitch MX MAC keyboard</h3>
                    <div class="price">$119.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 24) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="25" >
                    <img src="./assets/Images/produits/23.jpg" alt="">                    
                    <h3>apple magic keyboard</h3>
                    <div class="price">$139.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 25) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
        <!-- ------------ -->
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="26">
                    <img src="./assets/Images/produits/18.jpg" alt="">                    
                    <h3>logitch M510 Mouse</h3>
                    <div class="price">$27.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 26) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="27" >
                    <img src="./assets/Images/produits/19.jpg" alt="">                    
                    <h3>logitch MX 3S Mouse</h3>
                    <div class="price">$95.98</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 27) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="28">
                    <img src="./assets/Images/produits/20.jpg" alt="">                    
                    <h3>apple magic mouse</h3>
                    <div class="price">$99.00</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 28) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid" value="29">
                    <img src="./assets/Images/produits/21.jpg" alt="">                    
                    <h3>Gigabyte geforce RTX</h3>
                    <div class="price">$1699.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 29) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
                <div class="swiper-slide box">
                    <form action="user_page.php" method="post">
                    <input type="hidden" name="pid"  value="30">
                    <img src="./assets/Images/produits/28.jpg" alt="">                    
                    <h3>HP chargeur HSTNN</h3>
                    <div class="price">$19.99</div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                    <?php
        if (isset($_POST['add_to_cart']) && $_POST['pid'] == 30) {
            echo '<span class="added-msg">' . $message . '</span>';
        }
        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Products section end -->
    <!-- Reviews section strat -->
    <section class="reviews" id="reviews">
        <h1 class="heading"> customer's <span>review</span></h1>

        <div class="swiper review-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <img src="./assets/Images/ca821ff208476fdad21bc3f3b0f6a6cc.jpg" alt="">
                    <p>“I got a pair of processors from LaptopPartions and I'm very satisfied. They are high-quality and worth the money. The store also offered free shipping at that price so that’s a plus!”</p>
                    <h3>Gabriel Dupont</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="./assets/Images/1053f9de9072a5802c77972ed5031d0c.jpg" alt="">
                    <p>“I got a pair of processors from LaptopPartions and I’m very satisfied. They are high-quality and worth the money. The store also offered free shipping at that price so that’s a plus!”</p>
                    <h3>Émilie Gagnon</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="./assets/Images/hipster-haircut-side-swept-long-bang-full-beard.jpg" alt="">
                    <p>“I got a pair of processors from LaptopPartions and I’m very satisfied. They are high-quality and worth the money. The store also offered free shipping at that price so that’s a plus!”</p>
                    <h3>Alexandre Tremblay</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="./assets/Images/5c2c71a48d6d1a166c529c2c9d2c7348.jpg" alt="">
                    <p>“I got a pair of processors from LaptopPartions and I’m very satisfied. They are high-quality and worth the money. The store also offered free shipping at that price so that’s a plus!”</p>
                    <h3>Charlotte Roy</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="swiper-slide box">
                    <img src="./assets/Images/0df43e098acce8a88c3ae8a8827ffb88.jpg" alt="">
                    <p>“I got a pair of processors from LaptopPartions and I’m very satisfied. They are high-quality and worth the money. The store also offered free shipping at that price so that’s a plus!”</p>
                    <h3>Gabriel Dupont</h3>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- reviews section end -->
    <!-- footer section start -->
    <section class="footer" id="Contact Us">
        <div class="box-container">
            <div class="box">
                <h3>LaptopPartitions<img src="./assets/Images/laptop-partitions-high-resolution-logo-color-on-transparent-background (1).png" alt=""></h3>
                <p>Laptop Partitions provides affordable laptop parts and accessories, from batteries to screens and keyboards. Our friendly customer service team is always available to assist you. Upgrade and maintain your laptop with ease - shop with us today.</p>
                <div class="share">
                    <a href=" https://www.facebook.com" class="fab fa-facebook-f" target="_blank"></a>
                    <a href=" https://www.twitter.com" class="fab fa-twitter" target="_blank"></a>
                    <a href=" https://www.instagram.com" class="fab fa-instagram" target="_blank"></a>
                    <a href=" https://www.linkedin.com" class="fab fa-linkedin" target="_blank"></a>
                </div>
            </div>
            <div class="box">
                <h3>contact infos</h3>
                <a href="tel:+212623146790" class="links"><i class="fas fa-phone"></i>+212 623146790</a>
                <a href="tel:+212598537832" class="links"><i class="fas fa-phone"></i>+212 598537832</a>
                <a href="mailto:LapPartitions20@gmail.com" class="links"><i class="fas fa-envelope"></i>LapPartitions20@gmail.com</a>
                <a href="https://www.google.com/maps/place/Oujda+60000,+Morocco" target="_blank"class="links"><i class="fas fa-map-marker-alt"></i>Morocco, Oujda-60000</a>
            </div>
            <div class="box">
                <h3>quik links</h3>
                <a href="#home" class="links"><i class="fas fa-arrow-right"></i>home</a>
                <a href="#features" class="links"><i class="fas fa-arrow-right"></i>features</a>
                <a href="#products" class="links"><i class="fas fa-arrow-right"></i>products</a>
                <a href="#reviews" class="links"><i class="fas fa-arrow-right"></i>reviews</a>
            </div>
            <div class="box">
                <h3>payment</h3>
                <p>We offer multiple payment options for your convenience.</p>
                <img src="./assets/Images/25826-5-major-credit-card-logo-image.png" class="payement-img" alt="">
            </div>
        </div>
        <div class="credit">created by <span>Mohamed Bilal and mouad </span>| all rights reserved &copy;2023</div>
    </section>
    <!-- footer section end -->



    





    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="./assets/JS/script.js"></script>
</body>
</html>