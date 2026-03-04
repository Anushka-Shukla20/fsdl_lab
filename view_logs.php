<?php
$conn = new mysqli("localhost", "root", "", "fullstackdev");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM login_logs ORDER BY login_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Activity</title>

<style>

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #f8d7e3, #f3c1d9);
    padding: 50px;
}

.container {
    max-width: 1000px;
    margin: auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 18px;
    box-shadow: 0 20px 45px rgba(0,0,0,0.08);
}

h2 {
    margin-bottom: 30px;
    color: #9d174d;
    font-weight: 600;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    padding: 14px;
    text-align: left;
    background: #be185d;
    color: white;
    font-weight: 500;
    font-size: 14px;
}

td {
    padding: 14px;
    border-bottom: 1px solid #f3f4f6;
    font-size: 14px;
}

tr:hover {
    background-color: #fdf2f8;
}

/* STATUS BADGES */

.badge {
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.success {
    background-color: #fce7f3;
    color: #9d174d;
    border: 1px solid #f9a8d4;
}

.failed {
    background-color: #ffe4e6;
    color: #b91c1c;
    border: 1px solid #fca5a5;
}

.footer {
    margin-top: 25px;
    font-size: 13px;
    color: #6b7280;
}

</style>
</head>

<body>

<div class="container">

    <h2>Login Activity Logs</h2>

    <table>
        <tr>
            <th>Log ID</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Login Time</th>
            <th>Status</th>
        </tr>

        <?php
        while($row = $result->fetch_assoc()){

            $status = $row['status'];

            if($status == "SUCCESS"){
                $badge = "<span class='badge success'>SUCCESS</span>";
            } else {
                $badge = "<span class='badge failed'>FAILED</span>";
            }

            echo "<tr>
                    <td>".$row['log_id']."</td>
                    <td>".$row['user_id']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['login_time']."</td>
                    <td>".$badge."</td>
                  </tr>";
        }
        ?>

    </table>

    <div class="footer">
        Authentication monitoring dashboard
    </div>

</div>

</body>
</html>