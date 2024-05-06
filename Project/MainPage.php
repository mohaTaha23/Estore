<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="MainPageStyle.css">
    <title>Taha EStore</title>
</head>
<body>
    <header>
        <div class="nameAndLogo">
             Gifts Store <img src="./logos/storeLogo.png" width="64px" height="64px">    
        </div>
        <a href="AboutUs.html">about us</a> 
        <a href ="cart.html">
        <img src="./logos/cart.png" width="40px" height="40px"></a> 
        <?php
            session_start();
            if (count($_SESSION)>0 && $_SESSION['redirected']==true) {
                echo "<p> Welcome <strong><span style='color: white;'>".$_SESSION['name']."</span></strong></p>";
                $_SESSION['redirected']=false;
            }
            else{
                echo '<a href="register.php">Log in</a>';
            }
        ?>
    </header>
    <div class="section">
        <nav>
            <form id="searchForm" action="MainPage.php" method="get" class = "search">
                <input type="text" id="textInput" name="userInput" placeholder="🔍 Search"><br><br>
                <button type="submit" name = "search">Search</button>
            </form>
            <div class="order">
                <a href ="cart.html">
                    <img src="./logos/cart.png" width="40px" height="40px">
                </a>
                <p>Your order</p> 
            </div>
        </nav>
        <main>
            <?php
            try{
                require_once("./dbconfig.in.php");
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "<form method='post' action = 'MainPage.php'>";
                echo "<table border='1' width = 100%>
                    <tr>
                        <th><Photo</th>
                        <th><button type ='submit' name='ID'>Product ID</button></th>
                        <th><button type ='submit' name='Name'>Name</button></th>
                        <th>Category</th>
                        <th>Size</th>
                        <th><button type ='submit' name='Price'>Price</button></th>
                    </tr>";
                    if(isset($_GET['search'])){
                        $stmt = $pdo->prepare("SELECT * FROM Products WHERE Name LIKE :id");
                        $nameToSearch = $_GET['userInput'].'%';
                        $stmt->bindParam(":id",$nameToSearch);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result){
                            foreach ($result as $row) {
                                echo '<tr>';
                                        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Photo']) . "\"></td>";
                                        echo'
                                        <td><a href="view.php/?ID='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Category'].'</td>
                                        <td>'.$row['Size'].'</td>';
                                        echo "<td>".$row['Price']."</td>";
                                        echo'</tr>';
                            }   
                        }
                    }
                    else if(count($_POST) == 0){
                        $stmt = $pdo->prepare("SELECT * FROM Products");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result){
                            foreach ($result as $row) {
                                echo '<tr>';
                                        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Photo']) . "\"></td>";
                                        echo'
                                        <td><a href="view.php/?ID='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Category'].'</td>
                                        <td>'.$row['Size'].'</td>';
                                        echo "<td>".$row['Price']."</td>";
                                        echo'</tr>';
                            }   
                        }
                    }
                    elseif(isset($_POST['ID'])){
                        $stmt = $pdo->prepare("SELECT * FROM Products Order BY ProductID");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result){
                            foreach ($result as $row) {
                                echo '<tr>';
                                        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Photo']) . "\"></td>";
                                        echo'
                                        <td><a href="view.php/?ID='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Category'].'</td>
                                        <td>'.$row['Size'].'</td>';
                                        echo "<td>".$row['Price']."</td>";
                                        echo'</tr>';
                            }   
                        }
                    }
                    elseif(isset($_POST['Name'])){
                        $stmt = $pdo->prepare("SELECT * FROM Products Order BY Name");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result){
                            foreach ($result as $row) {
                                echo '<tr>';
                                        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Photo']) . "\"></td>";
                                        echo'
                                        <td><a href="view.php/?ID='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Category'].'</td>
                                        <td>'.$row['Size'].'</td>';
                                        echo "<td>".$row['Price']."</td>";
                                        echo'</tr>';
                            }   
                        }
                    }
                    elseif(isset($_POST['Price'])){
                        $stmt = $pdo->prepare("SELECT * FROM Products Order BY Price");
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result){
                            foreach ($result as $row) {
                                echo '<tr>';
                                        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Photo']) . "\"></td>";
                                        echo'
                                        <td><a href="view.php/?ID='.$row['ProductID'].'">'.$row['ProductID'].'</a></td>
                                        <td>'.$row['Name'].'</td>
                                        <td>'.$row['Category'].'</td>
                                        <td>'.$row['Size'].'</td>';
                                        echo "<td>".$row['Price']."</td>";
                                        echo'</tr>';
                            }   
                        }
                    }
                    
                    echo '</table>';
                echo "</form>";
            }
            catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </main>   
        </div>
    
    <footer>
        <div class="nameAndLogo">
            Gifts Store <img src="./logos/storeLogoSymbol.png" width="64px" height="64px">
            <div class="copyWrite">
                <h6>&copy; 2024 Mohammed Taha.</h6>
            </div>
        </div>
        Email: notRealEmail@email.com
        <a href="AboutUs.html">Contact Us!</a> 
    </footer>
</body>
</html>
