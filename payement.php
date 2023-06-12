<?PHP
    $conn =new PDO('mysql:host=localhost;dbname=user_db','root','');
    $query=$conn->query("SELECT ROUND(SUM(product_price),2) AS total_price FROM cart");
    $result=$query->fetch(PDO::FETCH_ASSOC);
    $totalPrice=$result['total_price'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payement</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- css file link -->
    <link rel="stylesheet"  href="./assets/CSS/styles3.css">
    </head>
<body>
    <section class="log-in-form">
    <div class="form-box">
        <form id="checkout-form">
        
            <div class="input-box">
                <ion-icon name="card-outline"></ion-icon>
                <input type="text" name="card-number" required>
                <label for="text">card-number:</label>
            </div>
            <div class="input-box">
                <ion-icon name="person-outline"></ion-icon>
                <input type="text"  name="card-holder" required>
                <label for="text">card-holder</label>
            </div>
            <div class="input-box">
                <ion-icon name="calendar-number-outline"></ion-icon>
                <input type="text"  name="expiry-date" required>
                <label for="text">expiry-date:</label>
            </div>
            <div class="input-box">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="text"  name="cvv" required>
                <label for="text">cvv:</label>
            </div>
            <div class="input-box-price">
                <ion-icon name="currency-dollar-outline"></ion-icon>
                <input type="text"  value="Total Price : <?php echo $totalPrice ; ?> $" readonly>
            </div>
            <input type="submit" name="submit" value="Valider" class="btn">
        </form>
    </div>
    </section>
    <div id="message-dialog">
        <div class="message-content">
            <h3>Thank you for your purchase!</h3>
            <p>Your products will be delivered shortly.</p>
            <button id="close-button">Close</button>
        </div>
    </div>
    <script>
        function showMessageDialog() {
    document.getElementById('message-dialog').style.display = 'block';
    }

   // Close the message dialog

    function closeMessageDialog() {
    document.getElementById('message-dialog').style.display = 'none';
    }

   // Handle form submission
    document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();

     // Show the message dialog after form validation/submit
    showMessageDialog();
    });

    // Add event listener to close button
    document.getElementById('close-button').addEventListener('click', closeMessageDialog);

    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>