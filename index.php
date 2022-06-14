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
                header('Location: index.php');
                die();
            }

        }
    }
}
if ($logged) {

    if($_POST !=null)
    {
        if (!empty($_POST['vardas']) && !empty($_POST['epastas']) && !empty($_POST['zinute'])) {

            $vardas = $_POST['vardas'];
            $epastas = $_POST['epastas'];
            $zinute = $_POST['zinute'];

            $sql = 'INSERT INTO mindaugas (id,vardas, epastas, zinute, ip, laikas)
    VALUES ("' . $id . '","' . $vardas . '", "' . $epastas . '", "' . $zinute . '", "' . $_SERVER['REMOTE_ADDR'] . '", NOW())';

            if (!$result = $conn->query($sql)) die("Negaliu irasyti:" . $conn->error);
            header("Location: index.php");
            die();
        }
    }
}
$_SESSION

?>
<?php

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

<?php
if ($logged)
{
?>
<a href='logout.php'><button>Logout</button> </a>
<?php
}
?>
<?php
if ($logged)
{

?>
<table class="table table-striped table-dark">
    <tr>
        <td>ID</td>
        <td>Vardas</td>
        <td>E.pastas</td>
        <td>zinute</td>
        <td>ip</td>
        <td>laikas</td>
        <td>Istrinti</td>
    </tr>
    <?php
    }
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
    <form action='index.php' method='Post' class="forma" >
        Vardas:<input name="vardas" type="text" id="vardas" ><br><br>
        E.pastas:<input name="epastas" type="text" id="epastas" ><br><br>
        Zinute:<textarea name="zinute"> </textarea><br><br>
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-secondary ml-2" value="Reset">
    </form>
<?php
}
else
{
?>
    <!-- Section: Design Block -->
    <section class=" text-center text-lg-start">
        <style>
            .rounded-t-5 {
                border-top-left-radius: 0.5rem;
                border-top-right-radius: 0.5rem;
            }

            @media (min-width: 992px) {
                .rounded-tr-lg-0 {
                    border-top-right-radius: 0;
                }

                .rounded-bl-lg-5 {
                    border-bottom-left-radius: 0.5rem;
                }
            }
        </style>
        <div class="card mb-3">
            <div class="row g-0 d-flex align-items-center">
                <div class="col-lg-4 d-none d-lg-flex">
                    <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes"
                         class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
                </div>
                <div class="col-lg-8">
                    <div class="card-body py-5 px-md-5">

                        <form method="post" name="signin-form">
                            <!-- username input -->
                            <div class="form-outline mb-4">
                                <input type="username" name="username" id="form2Example1" class="form-control" />
                                <label class="form-label" for="form2Example1">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example2" class="form-control" />
                                <label class="form-label" for="form2Example2">Password</label>
                            </div>

                            <!-- 2 column grid layout for inline styling -->
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col">
                                    <!-- Simple link -->
                                    <a href="#!">Forgot password?</a>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4"name="login" value="login">Log In</button>
                            <p>
                                Not yet a member? <a href="register.php">Sign up</a>
                            </p>

                        </form>
    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section: Design Block -->
<?php
}
?>
</body>

</html>
