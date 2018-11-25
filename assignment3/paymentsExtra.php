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
        <!--navbar-->
        <?php include "navbar.php" ?>    
    </header>
    
    <main>
        
        <?php
        // get information from url--------------------------------------
        $get_id = $_GET['id'];
        
        // title over table----------------------------------------------
        echo "<h2 class=\"center\">CUSTOMER NUMBER ".$get_id." DETAILS</h2>";
        
        // create table structure------------------------------------------------------
        echo "<table>";
        echo "<tr class=\"top\"><th>Phone Number</th><th>Sales Rep</th><th>Credit Limit</th></tr>";
        
       // Make connection to DB--------------------------------------------
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classicmodels";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully"; 
            $stmt = $conn->query("SELECT customers.phone, customers.salesRepEmployeeNumber, customers.creditLimit FROM customers WHERE customers.customerNumber = '$get_id'");
            
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            // second query for payment amounts for each customer
            $stmt2 = $conn->query("SELECT amount FROM payments WHERE customerNumber = '$get_id'");
            
            // set the resulting array to associative
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            
        }
        // message if connection error-----------------------------------------
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        // create table structure------------------------------------------------------
        while ($r = $stmt->fetch()) {
                    echo "<tr>";
                    echo    "<td>".$r['phone']."</td>";
                    echo    "<td>".$r['salesRepEmployeeNumber']."</td>";
                    echo    "<td>".$r['creditLimit']."</td>";
                    echo "</tr>";
        }
        // close table --------------------------------------
        echo "</table>";
        
        // enumerate all amounts by specified customer ---------------------------------------
        echo "<h2 class=\"center\">The payments made by customer number ".$get_id." so far are:</h2>";
        echo "<ul class\"center\">";
        $total_payment = 0;
        while ($i = $stmt2->fetch()) {
            echo "<li class=\"amounts_list\"><h2>€".$i['amount']."</h2></li>";
            $total_payment += $i['amount'];
        }
        echo "</ul>";
        
        // display the total payments by the customer selected in payments.php-----------------
        echo "<h2 class=\"center\">The total payments from customer number ".$get_id." is:</h2>";
        echo "<h1 class=\"center\">€".$total_payment."<h1>";
        
        // Close connection---------------------------------------
        $conn = null;
        
        echo "<h2 class=\"center\">CUSTOMER DETAILS</h2>";
        
        ?>
        
    </main>
    
    <footer>
        <!--navbar-->
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>