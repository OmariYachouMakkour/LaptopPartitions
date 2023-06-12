<?php
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');
    session_start();
    if (isset($_POST['submit'])) {
        $email= $_POST['email'];
        $email=filter_var($email,FILTER_SANITIZE_STRING);
        $pass=sha1($_POST['password']);
        $pass=filter_var($pass,FILTER_SANITIZE_STRING);
        $select = $conn->prepare("select * from user_form where email = ? AND password =?");
        $select->execute([$email,$pass]);
        $row = $select->fetch(PDO::FETCH_ASSOC);
        if($select->rowCount() >0){
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:user_page.php');
        }else{
            $error[]='incorrect email or password';
        }
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- css file link -->
    <link rel="stylesheet" href="./assets/CSS/styles2.css">
    </head>
<body>
    <section class="log-in-form">
        <div class="form-box">
            <form action="" method="POST">
                <h2>Login</h2>
                <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo '<span class="error-msg">'.$error.'</span>';
                        };
                    };
                ?>
                <div class="input-box">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <input type="submit" name="submit" value="sign in" class="btn">
                <div class="signup">
                    <p>Don't have an account <a href="signup.php">Sign up</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>