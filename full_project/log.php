<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
<p><input type="text" name="title" ></p>
<p><input type="password" name="pass" ></p>
<input type="submit"  value="submit"  name="submit">
    </form>
</body>
</html>

<?php
if(isset($_POST['submit'])){

$title=$_POST['title'];
$pass=$_POST['pass'];

echo empty($_POST['title']) ? "title is required<br>" : (preg_match('/[a-zA-Z]/', $_POST['title']) ? "title is valid<br>" : "title is not valid<br>");
echo empty($_POST['pass']) ? "password is required<br>" : 
    (!preg_match("/[a-z]/",$_POST['pass']) ? "password must have lower<br>" : "password valid lower<br>") .
    (!preg_match("/[A-Z]/",$_POST['pass']) ? "password must have upper<br>" : "password valid upper<br>") .
    (!preg_match("/[0-9]/",$_POST['pass']) ? "password must have numbers<br>" : "password valid number<br>") .
    (!preg_match("/[!@#$%^&*()-_=+{};:,<.>]/",$_POST['pass']) ? "password must have special characters<br>" : "password valid special characters<br>");



/* connect to database   */


 $host = "localhost";
 $username = "root";
 $password = "";
 $dbname = "cookie";
 $con = mysqli_connect($host, $username, $password, $dbname);
 
 if (!$con) {
     echo "fail coonection";
 }
 else{
     echo "connected to data successfully"."<br>";
 }
 
 




          /*   get data from database     */
 

 $final = mysqli_query($con," SELECT * FROM users WHERE title='$title' AND  password='$pass' ");

 if (!$final) {
    echo "fail coonection";
}
else{
    echo "get data from sql "."<br>";
}


if(mysqli_num_rows($final) > 0){

    $iti=mysqli_fetch_array($final);
    
    setcookie("usertitle",$iti['title'],time() + 60*60);
    
    header("location: products.php");
     }else{
        echo "fail coonection";
    }


}




?>