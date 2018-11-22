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
        
        <?php
        echo "<table>";
        echo "<tr class=\"top\"><th>Check Number</th><th>Payment Date</th><th>Amount</th><th>Customer No.</th><th>Extra Info</th></tr>";
        
       
        
        
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
            if ($start <= 20) {
                    echo "<tr>";
                    echo    "<td>".$r['checkNumber']."</td>";
                    echo    "<td>".$r['paymentDate']."</td>";
                    echo    "<td>".$r['amount']."</td>";
                    echo    "<td>".$r['customerNumber']."</td>";
                    echo    "<td class=\"button1\"><a href='paymentsExtra.php?id=".$r['customerNumber']."'><button class=\"button2\">Extra Info</button></a></td>";
                    echo "</tr>";
            }
            $start++;
        }
        echo "</table>";
        
        $conn = null;
        ?>
        
    </main>
    
    <footer>
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>


