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
        echo "<tr class=\"top\"><th>First Name</th><th>Last Name</th><th>Job Title</th><th>Email</th></tr>";
        
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "classicmodels";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully"; 
            $stmt = $conn->query("SELECT * FROM employees WHERE officeCode = '$get_id'");
            
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            
        }
        
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        
        
        while ($r = $stmt->fetch()) {
                    echo "<tr>";
                    echo    "<td>".$r['firstName']."</td>";
                    echo    "<td>".$r['lastName']."</td>";
                    echo    "<td>".$r['jobTitle']."</td>";
                    echo    "<td>".$r['email']."</td>";
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


