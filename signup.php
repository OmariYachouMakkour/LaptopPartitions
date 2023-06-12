<?php
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');
    if (isset($_POST['submit'])) {
        $name= $_POST['name'];
        $name=filter_var($name,FILTER_SANITIZE_STRING);
        $email= $_POST['email'];
        $email=filter_var($email,FILTER_SANITIZE_STRING);
        $id=$_POST['id'];
        $id=filter_var($id,FILTER_SANITIZE_STRING);
        $pass=sha1($_POST['password']);
        $pass=filter_var($pass,FILTER_SANITIZE_STRING);
        $cpass=sha1($_POST['cpassword']);
        $cpass=filter_var($cpass,FILTER_SANITIZE_STRING);
        $select = $conn->prepare("select * from user_form where email = ?");
        $select->execute([$email]);
        $row= $select->fetch(PDO::FETCH_ASSOC);

        if($select->rowCount() >0){
            $error[]="user already exist!";
        }else{
            if($pass!=$cpass){
                $error[]="password not matched!";
            }else{
                $insert=$conn->prepare("insert into user_form (name,email,password) values(?,?,?)");
                $insert->execute([$name,$email,$cpass]);
                header('location:signin.php');
            }
        }
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- css file link -->
    <link rel="stylesheet" type="text/css" href="./assets/CSS/styles2.css">
    </head>
<body>
    <section class="log-in-form">
        <div class="form-box">
            <form action="" method="POST">
                <h2>welcome!</h2>
                <?php
                    if(isset($error)){
                        foreach($error as $error){
                            echo'<span class="error-msg">' . $error . '</span>';
                        };
                    };
                ?>
                <div class="input-box" id="hidden">
                    <input type="hidden" name="id" >
                </div>
                <div class="input-box">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="name" oninput="this.value= this.value.replace(/\s/g, '')" value="" required>
                    <label for="text">full name</label>
                </div>
                <div class="input-box">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email" oninput="this.value= this.value.replace(/\s/g, '')" value="" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" oninput="this.value= this.value.replace(/\s/g, '')" value="" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-box">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="cpassword" oninput="this.value= this.value.replace(/\s/g, '')" value="" required>
                    <label for="password">confirme Password</label>
                </div>
                <input type="submit" name="submit" value="sign up" class="btn">
                <div class="signup">
                    <p>already have an account <a href="signin.php">Sign in</a></p>
                </div>
            </form>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>