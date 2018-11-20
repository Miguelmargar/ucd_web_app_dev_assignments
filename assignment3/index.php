<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header>
        <?php include "navbar.php" ?>    
    </header>
    
    <main>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=classicmodels", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully"; 
            }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
    
        ?>
    </main>
    
    <footer>
        <?php include "navbar.php" ?>
    </footer>
    
</body>
</html>