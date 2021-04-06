<?php

$roomname = $_GET['roomname'];

include 'db_connect.php';


$sql = "SELECT * FROM `rooms` WHERE roomname = '$roomname'";

$result = mysqli_query($conn, $sql);

if($result)
{
    if(mysqli_num_rows($result)==0)
    {
        $message = 'This room does not exist. Create a new one!';
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="rooms.php?roomname='.$room.'";';
            echo '</script>';
    }
}
else
{
    echo "ERROR : ". mysqli_error($conn);
}


?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Bootstrap core CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


<style>
body {
  margin: 0 auto;
  padding: 0 20px;
  height: 100%;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
  color: black;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass {
    height: 350px;
    overflow-y: scroll;
}
</style>

<link href="css/cover.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
<header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">Anon-Chat</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Contact</a>
      </nav>
    </div>
  </header>

<div style="margin-top: 20px;">

<h2>Room ID - <?php echo $roomname ?></h2>

<div class="anyClass">
<div class="container"></div></div>

<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Enter your message" val=""><br>
<button class="btn btn-default text-white" name="submitmsg" id="submitmsg" style="border: 2px solid white;">SEND</button>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<script type="text/javascript">

setInterval(runfunction, 1000);
function runfunction() 
{
    $.post("htcont.php", {room: '<?php echo $roomname ?>'},
        function(data, status)
        {
            document.getElementsByClassName('anyClass')[0].innerHTML = data;
        }

    )
}




// Get the input field
var input = document.getElementById("usermsg");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("submitmsg").click();
  }
});


// Jquery Post function
    $("#submitmsg").click(function(){
        var clientmsg = $("#usermsg").val();
        $.post("postmsg.php", {text: clientmsg, room: '<?php echo $roomname ?>', ip: '<?php $_SERVER['REMOTE_ADDR'] ?>'}, 
        function(data, status){ 
            document.getElementsByClassName('anyClass')[0].innerHTML = data;});
            $('#usermsg').val('');
        return false;
    });
</script>
</body>
</html>
