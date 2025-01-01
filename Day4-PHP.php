<?php
$error_fields = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!(isset($_POST['name']) && !empty($_POST['name']))){
        $error_fields[]='name';
    }

    if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[]='email';
    }

    
    if(!$error_fields){
        $conn=mysqli_connect("localhost" , "root" , "" , "Day4db");
        if(!$conn){
        echo mysqli_connect_error();
        exit;
        }
        $name=mysqli_escape_string($conn , $_POST['name']);
        $email=mysqli_escape_string($conn , $_POST['email']);
        $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
        $query = "INSERT INTO users (name , email , gender) VALUES ('".$name."','".$email."','".$gender."')";
        if(mysqli_query($conn,$query)){
            header("Location:Day4-PHP.php");
            exit;
        }
        else{
            echo mysqli_error($conn);
        }
        mysqli_close($conn);
    }

}
?>
<html>
    <head><title>Add User</title>
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
        .add{
            font-size:20px;
            margin-top:12px;
            background-color:RGB(191, 199, 193);
            width:15%;
        }
        
        </style>
</head>
<body>
    <form method="post" class="form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="inp" value="<?=(isset($_POST['name'])) ? $_POST ['name']:'' ?>" />
        <?php if(in_array("name" , $error_fields)) echo "*please enter name";?>
        <br />
        <label for="email"> Email </label>
        <input type="email" name="email" id="email"  class="inp" value="<?=(isset($_POST['email'])) ? $_POST ['email']:'' ?>" />
        <?php if(in_array("email" , $error_fields)) echo "*please enter valid email";?>
        <br />
        
        <input type = "radio" name = "gender" value = "M" > Male
        <input type = "radio" name = "gender" value = "F" > Female
        
        <br />
        <input type = "submit" name="submit" value="ADD user" class="add"/>
        
</form>
<button onclick="location.href='list.php'" class="add">Go to list</button>
</body>
</html>