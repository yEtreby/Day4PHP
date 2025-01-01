<?php
$error_fields = array();
$conn = mysqli_connect("localhost", "root", "", "Day4db");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}

$id=filter_input(INPUT_GET,'id');

$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!(isset($_POST['name']) && !empty($_POST['name']))){
        $error_fields[]='name';
    }

    if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[]='email';
    }


    $id=filter_input(INPUT_GET,'id');
    $name=mysqli_escape_string($conn , $_POST['name']);
    $email=mysqli_escape_string($conn , $_POST['email']);
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $query = "UPDATE users SET name = '$name' , email = '$email', gender = '$gender' WHERE users.id = " .$id ;
    if(mysqli_query($conn,$query)){
        header("Location:Day4-PHP.php");
        exit;
    }
    else{
        echo mysqli_error($conn);
    }}
   ?>
   <html>
   <head>
   <title>Edit User</title>
    <style>
        body{
            
        }
        .form{
            
            font-size:20px;
        }
        .inp{
            height:30px;
            width:15%;
            margin-top:10px;
        }
        .add , .edit{
            font-size:20px;
            margin-top:12px;
            background-color:RGB(191, 199, 193);
            width:15%;
        }
        
        </style>
        </head>
        
<body>
    <form method="post" class="form">
        <h1>This is Updating the user page </h1>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="inp" value="<?=(isset($row['name'])) ? $row ['name']:'' ?>" />
        <?php if(in_array("name" , $error_fields)) echo "*please enter name";?>
        <br />
        <label for="email"> Email </label>
        <input type="email" name="email" id="email"  class="inp" value="<?=(isset($row['email'])) ? $row ['email']:'' ?>" />
        <?php if(in_array("email" , $error_fields)) echo "*please enter valid email";?>
        <br />
        
        <input type = "radio" name = "gender" value = "M" > Male
        <input type = "radio" name = "gender" value = "F" > Female
        <br />
        <input type="submit" name="Edit" value ="Edit user" class="edit"/>
    </form>
</body>
</html>
        <?php
mysqli_close($conn);
mysqli_free_result($result);


?>
