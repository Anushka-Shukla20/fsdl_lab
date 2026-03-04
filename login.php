<?php
$conn = new mysqli("localhost", "root", "", "fullstackdev");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users_table 
            WHERE email='$email' AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        $log_sql = "INSERT INTO login_logs (user_id, email, login_time, status) 
                    VALUES ('$user_id', '$email', NOW(), 'SUCCESS')";
        $conn->query($log_sql);

        header("Location: login.php?status=success&name=".$row['name']);
        exit();

    } else {

        $log_sql = "INSERT INTO login_logs (user_id, email, login_time, status) 
                    VALUES (NULL, '$email', NOW(), 'FAILED')";
        $conn->query($log_sql);

        header("Location: login.php?status=failed");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #f8d7e3, #f3c1d9);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: #ffffff;
    padding: 45px;
    width: 360px;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

.card h2 {
    margin: 0 0 25px;
    font-weight: 600;
    color: #9d174d;
    text-align: center;
}

.input-group {
    margin-bottom: 18px;
}

input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    font-size: 14px;
    transition: 0.2s ease;
}

input:focus {
    border-color: #ec4899;
    outline: none;
    box-shadow: 0 0 0 3px rgba(236,72,153,0.15);
}

button {
    width: 100%;
    padding: 12px;
    background: #be185d;
    border: none;
    color: white;
    font-weight: 500;
    font-size: 15px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s ease;
}

button:hover {
    background: #9d174d;
}

.message {
    padding: 12px;
    margin-bottom: 18px;
    border-radius: 8px;
    font-size: 14px;
}

.success {
    background-color: #fce7f3;
    color: #9d174d;
    border: 1px solid #f9a8d4;
}

.error {
    background-color: #ffe4e6;
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

.footer {
    margin-top: 15px;
    text-align: center;
    font-size: 13px;
    color: #6b7280;
}

</style>
</head>
<body>

<div class="card">
    <h2>Sign In</h2>

    <?php
    if(isset($_GET['status'])){
        if($_GET['status'] == "success"){
            echo "<div class='message success'>
                    Login successful. Welcome, ".htmlspecialchars($_GET['name']).".
                  </div>";
        }
        if($_GET['status'] == "failed"){
            echo "<div class='message error'>
                    Invalid email or password.
                  </div>";
        }
    }
    ?>

    <form method="POST">
        <div class="input-group">
            <input type="email" name="email" placeholder="Email address" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="footer">
        Secure authentication system
    </div>
</div>

</body>
</html>