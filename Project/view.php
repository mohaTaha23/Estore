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
            $ID = $_GET["ID"];
            try {
                require_once("./dbconfig.in.php");
                $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
                // useful during initial development and debugging
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $pdo->prepare("SELECT * FROM Products WHERE ProductID =:id");
                $stmt->bindParam(':id', $ID,PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // fetch a record from result set into an associative array
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
                else{
                    echo "Error: No students with such ID found";
                }
                
            }
            catch (PDOException $e) {
                echo ( $e->getMessage() );
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

<body>
   
</body>
</html>