<?php 
$conn=mysqli_connect("localhost" , "root" , "" , "Day4db");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
$query="SELECT * FROM users";
$result=mysqli_query($conn,$query);


?>
<html>
    <head>
        <title>View users</title>
        <style>
        .col{
            padding:10px;
        }
        .add{
            font-size:20px;
            margin-top:12px;
            background-color:RGB(191, 199, 193);
            width:15%;
        }
        </style>
    </head>
    <body>
        <h1> View Users </h1>
        <form method="GET">
           
      
        </form>
        <button onclick="location.href='Day4-PHP.php'" class="add">Add User</button>
        <table>
            <thead>
                <tr>
                    <th class="col">Id</th>
                    <th class="col">Name</th>
                    <th class="col">Email</th>
                    <th class="col">Gender</th>
                    <th class="col">Actions</th>
</tr>
</thead>
<?php
while($row=mysqli_fetch_assoc($result)){
?>
    <tr>
        <td class="col"><?=$row['id']?></td>
        <td class="col"><?=$row['name']?></td>
        <td class="col"><?=$row['email']?></td>
        <td class="col"><?=($row['gender'])?></td>
        <td class="col"> <a href="view.php?id=<?=$row['id']?>">view</a> | <a href = "delete.php?id=<?=$row['id']?>">Delete</a></td>
</tr>
<?php

}
?>

</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>