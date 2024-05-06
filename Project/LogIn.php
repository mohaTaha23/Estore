<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="LogIn.css"> 
</head>
<body>
    <h2>Login</h2>
    <?php
        function handleRegistration() {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $password = $_POST['password'];

                require_once("./dbconfig.in.php");
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                // useful during initial development and debugging
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM Customer WHERE Name = :nam and Password = :pass";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":nam",$name);
                $stmt->bindParam(":pass",$password);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result){
                    $stmt->execute();
                    session_start();
                    $_SESSION['redirected'] = true;
                    $_SESSION['name'] = $name;
                    header("Location: MainPage.php");
                    exit();
                } 
                else {
                    echo "<script>alert('Doesnt exist!');</script>";
                }

            }
        }
        handleRegistration();
    ?>
    <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group">
            <label for="name">Your name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>
</html>