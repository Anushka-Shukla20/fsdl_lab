<?php
$conn = new mysqli("localhost", "root", "", "fullstackdev");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$type = "";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = "SELECT * FROM users_table WHERE email='$email'";
    $result = $conn->query($check);

    if($result->num_rows > 0){
        $message = "An account with this email already exists.";
        $type = "error";
    } else {
        $sql = "INSERT INTO users_table (name, age, email, password) 
                VALUES ('$name', '$age', '$email', '$password')";
        if($conn->query($sql) === TRUE){
            $message = "Account created successfully.";
            $type = "success";
        } else {
            $message = "Something went wrong. Please try again.";
            $type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Account</title>
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
    width: 380px;
    border-radius: 16px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

.card h2 {
    margin-bottom: 25px;
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
    <h2>Create Account</h2>

    <?php
    if($message != ""){
        echo "<div class='message $type'>$message</div>";
    }
    ?>

    <form method="POST">
        <div class="input-group">
            <input type="text" name="name" placeholder="Full name" required>
        </div>

        <div class="input-group">
            <input type="number" name="age" placeholder="Age" required>
        </div>

        <div class="input-group">
            <input type="email" name="email" placeholder="Email address" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" name="submit">Create Account</button>
    </form>

    <div class="footer">
        Secure pink authentication system
    </div>
</div>

</body>
</html>