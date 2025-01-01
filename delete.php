<?php
$conn=mysqli_connect("localhost" , "root" , "" , "Day4db");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
$id=filter_input(INPUT_GET,'id');
$query="DELETE from users where users.id=" .$id." LIMIT 1";
if(mysqli_query($conn,$query)){
    header("location: list.php");
    exit;
}
else{
    echo mysqli_error($conn);
}
mysqli_close($conn);