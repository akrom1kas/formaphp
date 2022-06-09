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
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Laboratorinis darbas</title>
</head>
<body>
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

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti:" . $conn->connect_error);

    $sql = "SELECT * FROM mindaugas";
    if (!$result = $conn->query($sql)) die("Negaliu prisijungti:" . $conn->error);

    // prisijungti

    $conn = new mysqli($server, $user, $password, $dbname);
    if ($conn->connect_error) die("Negaliu prisijungti:" . $conn->connect_error);


    // define variables and set to empty values
    $vardasErr = $epastasErr = $zinuteErr = $websiteErr = "";
    $vardas = $epastas = $zinute  = $website = "";

    // irasyti

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
    ?>

<?php
    $num=mysqli_num_rows($query);
    if ($num>0) {
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
    $conn->close();
    ?>
  </table>
    <form action='index.php' method='post' class="forma" >
        Vardas:<br><input name="vardas" type="text" id="vardas" required><br><br>
        E.pastas:<br><input name="epastas" type="text" id="epastas" required><br><br>
        Zinute:<br> <textarea name="zinute"> </textarea><br><br>
        <input type='submit'  name="submit" <button></button></input><br><br>
    </form>

</body>

</html>
