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
        
        echo "<h2 class=\"center\">OFFICES</h2>";
        // create table structure------------------------------------------------------
        echo "<table>";
        echo "<tr class=\"top\"><th>City</th><th>Street</th><th>Street No.</th><th>Phone No.</th><th>Extra Info</th></tr>";
        
        
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
            $stmt = $conn->query("SELECT * FROM offices");
            
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
        }
        // message if connection error-----------------------------------------  
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        
        // populate table------------------------------------------------------
        while ($r = $stmt->fetch()) {
                    echo "<tr>";
                    echo    "<td>".$r['city']."</td>";
                    echo    "<td>".$r['addressLine1']."</td>";
                    echo    "<td>".$r['addressLine2']."</td>";
                    echo    "<td>".$r['phone']."</td>";
                    // button to redirect to further information with info in url------------------
                    echo    "<td class=\"button1\"><a href='officesExtra.php?id=".$r['officeCode']."&office=".$r['city']."'><button class=\"button2\">Extra Info</button></a></td>";
                    echo "</tr>";
        }
        // close table --------------------------------------
        echo "</table>";
        // Close connection---------------------------------------
        $conn = null;
        
        echo "<h2 class=\"center\">OFFICES</h2>";
        
        ?>
        
    </main>
    
    <footer>
        <!--navbar-->
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>


