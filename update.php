<?php
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');
    session_start();
    $user_id=$_SESSION['user_id'];
    $user_name=$_SESSION['user_name'];
    $user_email=$_SESSION['user_email'];
    if (isset($_POST['submit'])) {
        $name=$_POST['name']; 
        $name=filter_var($name,FILTER_SANITIZE_STRING);
        $email= $_POST['email']; 
        $email=filter_var($email,FILTER_SANITIZE_STRING);

        $update=$conn->prepare("UPDATE user_form SET name = ?, email = ? WHERE id = ?",);
        $update->execute([$name,$email,$user_id]);

            $empty_pass='da39a3ee5e6b40d3255fbeff95601890afd80709';

        $select_prev_pass= $conn->prepare("SELECT password from user_form WHERE id=?");
        $select_prev_pass->execute([$user_id]);
        $fetch_old_pass= $select_prev_pass->fetch(PDO::FETCH_ASSOC);
        $prev_pass=$fetch_old_pass['password'];
        $old_pass=sha1($_POST['opassword']);
        $old_pass=filter_var($old_pass,FILTER_SANITIZE_STRING);
        $new_pass=sha1($_POST['npassword']);
        $new_pass=filter_var($new_pass,FILTER_SANITIZE_STRING);
        $confirm_pass=sha1($_POST['cpassword']);
        $confirm_pass=filter_var($confirm_pass,FILTER_SANITIZE_STRING);

        if($prev_pass!= $old_pass){
            $message[]="old password not matched!";
        }elseif($new_pass!=$confirm_pass){
            $message[]="Confirm password not matched!";
        }else{
            if($new_pass!=$empty_pass){
                $update_pass=$conn->prepare("UPDATE user_form SET password = ? WHERE id = ?");
                $update_pass->execute([$confirm_pass, $user_id]);
                $message[]="informations updated successfully";
            }else{
                $message[]="please enter a password!";
            }
    };
};
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- css file link -->
    <link rel="stylesheet" type="text/css" href="./assets/CSS/styles2.css">
    </head>
<body>
    <section class="log-in-form" id="upd">
        <div class="form-box">
            <form action="" method="POST">
                <h2>Update your infos</h2>
                <?php
                    if(isset($message)){
                        foreach($message as $message){
                            echo'<span class="error-msg">' . $message . '</span>';
                        };
                    };
                ?>
                <div class="input-box" id="hidden">
                    <input type="hidden" name="id" >
                </div>
                <div class="input-box">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="name" oninput="this.value= this.value.replace(/\s/g, '')" value="<?php echo $user_name;?>" required>
                    <label for="text">full name</label>
                </div>
                <div class="input-box">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="email"  oninput="this.value= this.value.replace(/\s/g, '')" value="<?php echo $user_email;?>" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="opassword"  oninput="this.value= this.value.replace(/\s/g, '')"  required>
                    <label for="password">Old Password</label>
                </div>
                <div class="input-box">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="npassword"  oninput="this.value= this.value.replace(/\s/g, '')" required>
                    <label for="password">New Password</label>
                </div>
                <div class="input-box">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="cpassword"  oninput="this.value= this.value.replace(/\s/g, '')" required>
                    <label for="password">Confirme Password</label>
                </div>
                <input type="submit" name="submit" value="update" class="btn">
            </form>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>