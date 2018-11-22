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
        $get_id = $_GET['id'];
        echo "<table>";
        echo "<tr class=\"top\"><th>Phone Number</th><th>Sales Rep</th><th>Credit Limit</th><th>Payments</th></tr>";
        
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classicmodels";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully"; 
            $stmt = $conn->query("SELECT customers.phone, customers.salesRepEmployeeNumber, customers.creditLimit, payments.amount FROM payments, customers WHERE customers.customerNumber = payments.customerNumber and payments.customerNumber = '$get_id'");
            
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
        }
        
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        
        while ($r = $stmt->fetch()) {
                    echo "<tr>";
                    echo    "<td>".$r['phone']."</td>";
                    echo    "<td>".$r['salesRepEmployeeNumber']."</td>";
                    echo    "<td>".$r['creditLimit']."</td>";
                    echo    "<td>".$r['amount']."</td>";
                    echo "</tr>";
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


