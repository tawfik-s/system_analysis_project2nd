<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="../css/kitchen.css">
    <meta http-equiv="refresh" content="3">
</head>

<body>

<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>phone</th><th>email</th><th>customer_phone</th><th>time</th><th>table_num</th><th>room</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
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
$dbname = "sysproj2";
$complete="select name , email from customer;";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT customer.phone,customer.email,customer.name,customer.roomnum, orders.time,orders.table_num
    FROM orders
     JOIN Customer ON orders.customer_phone=Customer.phone");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

</body>
</html>