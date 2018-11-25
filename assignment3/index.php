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
        
        echo "<h2 class=\"center\">PRODUCT CATEGORIES</h2>";
        // create table structure------------------------------------------------------
        echo "<table>";
        echo "<tr class=\"top\"><th>Product Line</th><th>Description</th></tr>";
        
        class TableRows extends RecursiveIteratorIterator { 
            function __construct($it) { 
                parent::__construct($it, self::LEAVES_ONLY); 
            }
        
            function current() {
                return "<td>" . parent::current(). "</td>";
            }
            
            function beginChildren() { 
                echo "<tr>"; 
            }
            
            function endChildren() { 
                echo "</tr>" . "\n";
            }
        }
        
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
            $stmt = $conn->prepare("SELECT productLine, textDescription FROM productlines");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
            
        }
           // message if connection error-----------------------------------------  
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        // Close connection---------------------------------------
        $conn = null;
        // close table --------------------------------------
        echo "</table>";
        
        echo "<h2 class=\"center\">PRODUCT CATEGORIES</h2>";
        ?>
    </main>
    
    <footer>
        <!--navbar-->
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>