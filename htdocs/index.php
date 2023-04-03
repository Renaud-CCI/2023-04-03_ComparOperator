<?php

// require_once("traitement/database.php");


if (isset($_POST['user_name'])) {
    // Sanitize and validate the user name
    $user_name = filter_var($_POST['user_name']);
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $user_name)) {
        echo "<p class='erreur'>Le pseudo ne doit contenir que des lettres, des chiffres et des tirets bas</p>";
        exit;
    }

    // Check if the user name already exists
    $checkuser = "SELECT * FROM user WHERE user_name = :user_name";
    $stmt = $conn->prepare($checkuser);
    $stmt->bindParam(':user_name', $user_name);
    $stmt->execute();
    $count = $stmt->rowCount();
    if ($count > 0) {
        echo "<div class='erreur2'>Ce pseudo n'est plus disponible</div>";
    } else {
        // Insert the user name into the database
        $insertuser = "INSERT INTO user (user_name) VALUES (:user_name)";
        $stmt = $conn->prepare($insertuser);
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();
        header('Location: login.php');
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CUSTOM LOGIN CSS -->
    <link rel="stylesheet" href="/htdocs/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <title>Register|ComparOperator</title>

</head>

<body>

    <div class="container overflow-hidden">
        <div class="screen">
            <div class="screen__content">
                <div class="text-center">
                    <h2 class="fancy pt-4">Register</h2>
                </div>
                <form class="login" method="post" action="login.php">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input text-sandyellow" placeholder="User name / Email">
                    </div>

                    <button class="button login__submit">
                        <span class="button__text">Register</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div class="d-flex justify-content-center">
                    <h5>already registered ?</h5>
                </div>
                <div class="d-flex justify-content-center">

                    <form action="login.php">
                        <input type="submit" class="register mb-4" value="Login">
                    </form>

                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>





</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="/htdocs/js/login.js"></script>

</html>