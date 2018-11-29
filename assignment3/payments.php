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
        <?php include "navbar.php"?>    
    </header>
    
    <main>
        <h2 class="center">PAYMENTS</h2>
        
        <h3 class="center">SELECT THE AMOUNT OF PAYMENTS YOU WANT TO DISPLAY:</h3>
        <!--form --------------------------------------------------->
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
        // Error handler function
        function customError($errno, $errstr) {
            echo "<b>Error:</b> [$errno] $errstr";
        }
        // Set error handler
        set_error_handler("customError");
        
        // condition for default number of payments to be shown---------------------------
        if (!(isset($_POST['vals']))) {
            $val = 20;
        } else {
            $val = $_POST['vals'];
        }
        
        // create table structure------------------------------------------------------
        echo "<table>";
        echo "<tr class=\"top\"><th>Check Number</th><th>Payment Date</th><th>Amount</th><th>Customer No.</th></tr>";
        
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
            $stmt = $conn->query("SELECT * FROM payments");
            
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
        }
        // message if connection error-----------------------------------------
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        // populate table------------------------------------------------------
        // counter
        $start = 1;
        // while there is information fo
        while ($r = $stmt->fetch()) {
            // if the counter is the value passed by the form print up to the value passed - within loop
            if ($start <= $val) {
                    echo "<tr>";
                    echo    "<td>".$r['checkNumber']."</td>";
                    echo    "<td>".$r['paymentDate']."</td>";
                    echo    "<td>".$r['amount']."</td>";
                    echo    "<td><a class=\"click\" href='paymentsExtra.php?id=".$r['customerNumber']."'>".$r['customerNumber']."</a></td>";
                    echo "</tr>";
            }
            // up the value of counter by one when succesfull loop
            $start++;
        }
        // close table --------------------------------------
        echo "</table>";
        
        // Close connection---------------------------------------
        $conn = null;
        
        echo "<h2 class=\"center\">PAYMENTS</h2>";
        
        ?>
        
    </main>
    
    <footer>
        <!--navbar-->
        <?php include "navbar.php"?>
    </footer>
    
</body>
</html>


