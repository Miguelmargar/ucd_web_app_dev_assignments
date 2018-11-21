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
        echo "<tr><th>Customer Number</th><th>Check Number</th><th>Payment Date</th><th>Amount</th></tr>";
        
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
        
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classicmodels";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully"; 
            $stmt = $conn->prepare("SELECT customerNumber, checkNumber, paymentDate, amount  FROM payments");
            $stmt->execute();
            
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
                echo $v;
            }
            
        }
            
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        $conn = null;
        echo "</table>";
        ?>
    </main>
    
    <footer>
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>