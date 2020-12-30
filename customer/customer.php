<?php

$name = $email = $phone = $notes = $time= $roomNum=$tableNum = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone = test_input($_POST["phone"]);
  $notes = test_input($_POST["notes"]);
  $time = test_input($_POST["time"]);
  $roomNum = test_input($_POST["roomnum"]);
  $tableNum = test_input($_POST["tablenum"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sysproj2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO customer (phone, email, name,roomnum)
VALUES ('$phone', '$email', '$name','$roomNum')";

if ($conn->query($sql) === TRUE) {
    $sql = "INSERT INTO orders (customer_phone, descrption, time,table_num )
VALUES ('$phone', '$notes', '$time','$tableNum')";

if ($conn->query($sql) === TRUE) {
     
} else {
    echo "we can't add you order";
}
} else {
    echo "your data is entered pefore";
}


$conn->close();



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/customer.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
</head>
<body>
    <h1>please fill data to book a table</h1>
<div>
    
<div class="dropdown">
    <button class="dropbtn">menu</button>
    <div class="dropdown-content">
    <a target="_blank" href="../picture/foodmenu.jpg">food menu</a>
    <a target="_blank" href="../picture/drinkMenu.jpg">drink menu</a>
    </div>
  </div>
 
    <a class="plan" target="_blank" href="../picture/restaurant palan.jpg">food menu</a>

  </div>
    <center>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="name"> Name</label>
                <input type="text" id="name" name="name" placeholder="Your name.." autocomplete>

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Your phone number..." autocomplete>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="your email...... " autocomplete>
                <br>

            
                <textarea name="notes" rows="15">
                Write your food notes to prepare food faster write food description
                    </textarea>
                    <br>
                    <br>
                <label for="time">inter the time and  restaurant close at 1 AM</label>
                <input type="time" name="time">
                <br>
                <br>
                <label> your are from the hotel click yes to pring the food into the room</label>
                <br>
                <input id="roomyes"type="radio" name="check" onclick="enterroom()">yes <br>
                <input id="roomno"type="radio" name="check" onclick="deleteenterroom()">no
                <div id="room">
                    the number of the room
                    <input id="roomnum" type="number" name="roomnum" min="0" max="100" >
                </div>
                <br>
                <label for="tablenum">table number</label>
                <input id="tablenum" type="number" name="tablenum" min="0" max="100"  >
                <input type="submit" value="Submit">
            </form>

   </center>
</div>
<script>
    document.getElementById("roomnum").style.visibility="hidden";
    function enterroom() {
       // console.log("in");
        document.getElementById("roomnum").style.visibility="visible";
    }
    function deleteenterroom() {
       // console.log("in")
        document.getElementById("roomnum").style.visibility="hidden";
    }
</script>

</body>

<!-- Mirrored from www.w3schools.com/css/tryit.asp?filename=trycss_forms by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jul 2018 02:07:39 GMT -->
</html>
