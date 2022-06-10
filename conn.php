<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli('localhost','root','adminas', 'test');
if ($conn->connect_error){
    die('Connection failed : '.$conn->connect_error);
}
else
{
    $stmt = $conn->prepare("insert into users(username, email, password)
        values(?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    echo "registration successfully";
    $stmt->close();
    $conn->close();
}
$sql = "SELECT * FROM users WHERE username = ['$username'] OR email = ['$email'] LIMIT 1";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user) { // if user exists
    if ($user['username'] === $username) {
        array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
        array_push($errors, "email already exists");
    }
}

?>
