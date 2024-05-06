<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration</title>
    <link rel="stylesheet" href="registerStyle.css"> <!-- Link to external CSS file -->
</head>
<body>
    <h2>Customer Registration Form</h2>
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
                    echo "User already exists";
                } 
                else {
                    $address = $_POST['address'];
                    $dob = $_POST['dob'];
                    $email= $_POST['email'];
                    $telephone= $_POST['telephone'];
                    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                    // useful during initial development and debugging
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO Customer (Name,Password, Address, DateOfBirth, Email, Telephone) VALUES (:nam,:pass,:address, :dob,:email, :telephone)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":nam",$name);
                    $stmt->bindParam(":pass",$password);
                    $stmt->bindParam(":address",$address);
                    $stmt->bindParam(":dob",$dob);
                    $stmt->bindParam(":email",$email);
                    $stmt->bindParam(":telephone",$telephone);
                    $stmt->execute();
                    session_start();
                    $_SESSION['redirected'] = true;
                    $_SESSION['name'] = $name;
                    header("Location: MainPage.php");
                    exit();
                }

            }
        }
        handleRegistration();
    ?>
    <form id="registrationForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
        <div class="input-group">
            <label for="name">Name <span class="required">*</span>:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="password">Password <span class="required">*</span>:</label>
            <input type="text" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="address">Address <span class="required">*</span>:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="input-group">
            <label for="dob">Date of Birth <span class="required">*</span>:</label>
            <input type="date" id="dob" name="dob" required>
        </div>
        <div class="input-group">
            <label for="email">Email <span class="required">*</span>:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="telephone">Telephone <span class="required">*</span>:</label>
            <input type="tel" id="telephone" name="telephone" required>
        </div>
        <button type="submit">Register</button>
    </form>
    <form action = "LogIn.php" method ="Get">
        <button type="submit" class = "log">Already Have an account?</button>
    </form>
</body>
</html>
