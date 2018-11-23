<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <title>Document</title>
</head>
<body>
    <header>
        <?php include "navbar.php" ?>    
    </header>
    
    <main>
        <h2 class="center">PAYMENTS</h2>
        
        <h3 class="center">SELECT THE AMOUNT OF PAYMENTS YOU WANT TO DISPLAY:</h3>
        
            <form class="center" method="post" action="">
                <select name="vals">
                    <option value="20" selected>20</option>
                    <option value="40">40</option>
                    <option value="60">60</option>
                </select>
                <input id="select" type="submit" name="submit"/>
            </form>
            <br>
            
        <?php
        if (!(isset($_POST['vals']))) {
            $val = 20;
        } else {
            $val = $_POST['vals'];
        }
        
        
        echo "<table>";
        echo "<tr class=\"top\"><th>Check Number</th><th>Payment Date</th><th>Amount</th><th>Customer No.</th></tr>";
        
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classicmodels";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully"; 
            $stmt = $conn->query("SELECT * FROM payments");
            
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
        }
        
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        
        $start = 1;
        while ($r = $stmt->fetch()) {
            if ($start <= $val) {
                    echo "<tr>";
                    echo    "<td>".$r['checkNumber']."</td>";
                    echo    "<td>".$r['paymentDate']."</td>";
                    echo    "<td>".$r['amount']."</td>";
                    echo    "<td><a href='paymentsExtra.php?id=".$r['customerNumber']."'>".$r['customerNumber']."</a></td>";
                    echo "</tr>";
            }
            $start++;
        }
        echo "</table>";
        
        $conn = null;
        
        echo "<h2 class=\"center\">PAYMENTS</h2>";
        
        ?>
        
    </main>
    
    <footer>
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>


