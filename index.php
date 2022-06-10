<?php
$server="localhost";
$user="root";
$password="adminas";
$dbname="test";

include "connection.php";

if (isset($_GET['id'])){
    $id=$_GET['id'];
    $delete=mysqli_query($connection,"DELETE FROM `mindaugas` WHERE `id`= '$id'");
}

$select="SELECT * FROM mindaugas";
$query=mysqli_query($connection, $select);

?>

<?php
SESSION_START();

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) die("Negaliu prisijungti:" . $conn->connect_error);


$logged = false;

if (isset($_SESSION['user']))
{
    $logged = true;
}
else
{
    if(isset($_POST['login']))
    {
        if(!empty($_POST['username']) && !empty($_POST['password']))
        {
            $sql = "SELECT * FROM users where username ='".$_POST['username']."' and password = '".$_POST['password']."'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result))
            {
                $_SESSION['user'] = $row;
            }

        }
    }
}

if ($logged){

    if($_POST !=null)
    {
        $vardas = $_POST['vardas'];
        $epastas = $_POST['epastas'];
        $zinute = $_POST['zinute'];


        $sql = 'INSERT INTO mindaugas (id,vardas, epastas, zinute, ip, laikas)
    VALUES ("'.$id.'","'.$vardas.'", "'.$epastas.'", "'.$zinute.'", "'.$_SERVER['REMOTE_ADDR'].'", NOW())';

        if (!$result = $conn->query($sql)) die("Negaliu irasyti:" . $conn->error);
        header("Location: index.php");
        exit();
    }
}
$_SESSION

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Laboratorinis darbas</title>
</head>
<body>
<a href='logout.php'>Logout</a>
<table class="table table-bordered table-dark" border="2px";>
    <tr>
        <td>ID</td>
        <td>Vardas</td>
        <td>E.pastas</td>
        <td>zinute</td>
        <td>ip</td>
        <td>laikas</td>
    </tr>
    <?php

    // prisijungti

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti:" . $conn->connect_error);

    ?>

<?php
if ($logged) {
    $num = mysqli_num_rows($query);
    if ($num > 0) {
        while ($result = mysqli_fetch_assoc($query)) {
            echo "  
                 <tr class='lentele'>
                    <td>" . $result['id'] . "</td>
                    <td>" . $result['vardas'] . "</td>
                    <td>" . $result['epastas'] . "</td>
                    <td>" . $result["zinute"] . "</td>
                    <td>" . $result["ip"] . "</td>
                    <td>" . $result["laikas"] . "</td>
                    <td><a href='index.php?id=" . $result['id'] . "'>Delete</a></td>
                    </tr>";
        }
    }
}
    ?>
  </table>

<?php
    if ($logged)
{
?>
    <form action='index.php' method='post' class="forma" >
        Vardas:<input name="vardas" type="text" id="vardas" required><br><br>
        E.pastas:<input name="epastas" type="text" id="epastas" required><br><br>
        Zinute:<textarea name="zinute"> </textarea><br><br>
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
    </form>
<?php
}
else
{
?>
<br><br>
<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Username:</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Password:</label>
        <input type="password" name="password" required />
    </div><br>
    <button type="submit" class="btn btn-primary" name="login" value="login">Log In</button>
</form>

<?php
}
?>
</body>

</html>
