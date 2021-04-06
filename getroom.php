<?php
$room = $_POST['room'];
$message;

if (strlen($room)>20 or strlen($room)<2)
{
    $message = 'Room name should be between 2 and 20 characters';
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="/";';
    echo '</script>';
}

else if(!ctype_alnum($room))
{
    $message = 'Room name should be alphanumeric';
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="/";';
    echo '</script>';
    
}

else
{
    //connect to database
    include 'db_connect.php';
}



//room existence check

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room';";
$result = mysqli_query($conn, $sql);
if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        $message = 'This room is already claimed. Please choose a different room.';
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="/";';
        echo '</script>';
    }

    else
    {
        // INSERT INTO `rooms` (`sno`, `roomname`, `stime`) VALUES (NULL, 'test2', current_timestamp());
        $sql ="INSERT INTO `rooms` (`roomname`, `stime`) VALUES ( '$room', CURRENT_TIMESTAMP);";
        if (mysqli_query($conn, $sql))
        {
            $message = 'YOUR ROOM HAS BEEN CREATED!';
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="rooms.php?roomname='.$room.'";';
            echo '</script>';
        }
    }
}

else
{
    echo mysqli_error($conn);
}


?>