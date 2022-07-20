<?php 

$server = "localhost";
$username = "root";
$password = "";
$database = "notes";
$con = mysqli_connect($server, $username, $password, $database);
if(!$con){
    die("connection failed");
}

if(isset($_GET['delete'])){
    $sno = $_GET['delete'];
    $sql = "DELETE FROM `notes` WHERE `notes`.`sno` = '$sno'";
    $con->query($sql);
}
if($_SERVER["REQUEST_METHOD"]  == "POST"){
    if($_POST["title"] and $_POST["content"]){
        $title = $_POST["title"];
        $content = $_POST["content"];
        
        if($_POST["update"]>0){
            $sno = $_POST["update"];
            $sql = "UPDATE `notes` SET `title` = '$title', `content` = '$content' WHERE `notes`.`sno` = '$sno'";
            
            $con->query($sql);
        }
        else{
        $sql = "INSERT INTO `notes` (`title`, `content`, `dt`) VALUES ('$title', '$content', current_timestamp())";

        if($con->query($sql) == TRUE){
        // echo "Successfully Inserted";
        }
        else{
            echo "ERROR : $con->error";
        }
    }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes-App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>Welcome to notes app!</h1>
    <form action="/notes-app/index.php" method="post" class="form">
        <input type="text" name="title" placeholder="Enter the title">
        <textarea name="content" id="" cols="20" rows="4" placeholder="Here goes the content"></textarea>
        <button>Add Note</button>
    </form>
    </div>
    <div class="notes-section">
    <?php 
    $sql = "SELECT * FROM `notes`";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='note'>";
        echo "<h1>".$row["title"]."</h1>";
        echo "<p>".$row["content"]."</p>";
        echo "<div><button class='deletes' id=".$row["sno"].">Delete</button>";
        echo "<button class='updates' id='u".$row["sno"]."'>Update</button></div>";
        echo '<form action="/notes-app/index.php" method="post" class="update-form" id="u'.$row["sno"].'-form">
        <input type="text" name="title" placeholder="Enter the title">
        <textarea name="content" id="" cols="20" rows="4" placeholder="Here goes the content"></textarea>
        <input type="hidden" name="update" value="'.$row["sno"].'">
        <button>Update Note</button>
        <button class="form-close">Close</button>
    </form>';
        echo "</div>";
    }
    ?>
    </div>
    
</body>
<script src="index.js"></script>
</html>