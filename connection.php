<?php

include("components.php");

function createDatabase($dbName, $tableName)
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Creating connection
    $conn = mysqli_connect($servername, $username, $password);
    // Checking connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Creating a database name
    $sql = "CREATE DATABASE IF NOT EXISTS $dbName;";

    if (mysqli_query($conn, $sql)) {
        textNode("Database created successfully with the name : $dbName", "alert alert-success");

        $conn = mysqli_connect($servername, $username, $password, $dbName);

        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
                id INT(11) AUTO_INCREMENT,
                username VARCHAR(100) DEFAULT '',
                email VARCHAR(100) DEFAULT '',
                password VARCHAR(100) DEFAULT '',
                PRIMARY KEY(id)
                );";

        if (mysqli_query($conn, $sql)) {
            textNode("Table created successfully with the name : $tableName", "alert alert-success");
        } else {
            textNode("Error creating table: $tableName", "alert alert-danger") . mysqli_error($conn);
        }
    } else {
        textNode("Error creating database: $dbName", "alert alert-danger") . mysqli_error($conn);
    }

    // closing connection
    mysqli_close($conn);
}

$db = @$_POST['database'];
$tb = @$_POST['table'];
$submit = @$_POST['submit'];

if (isset($submit)) {
    createDatabase($db, $tb);
}

function deleteDb($dbName)
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Creating connection
    $conn = mysqli_connect($servername, $username, $password);
    // Checking connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Creating a database name
    $sql = "DROP DATABASE $dbName;";

    if (mysqli_query($conn, $sql)) {
        textNode("Database deleted successfully : $dbName", "alert alert-success");
    } else {
        textNode("Error deleting database: $dbName", "alert alert-danger") . mysqli_error($conn);
    }

    // closing connection
    mysqli_close($conn);
}
$deleteDb = @$_POST['delete_database'];
$deleteSubmit = @$_POST['del-submit'];

if (isset($deleteDb)) {
    deleteDb($deleteDb);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection to Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <!-- FontAwesome 6.1.1 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <section id="content">
        <i class="fa fa-database display-2 mb-3" aria-hidden="true"></i>
        <h1>Set database and table name</h1>
        <form action="connection.php" method="post" class="mb-5">
            <div class="mb-3">
                <input type="text" name="database" placeholder="Database Name" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="text" name="table" placeholder="Tabel Name" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button>
        </form>
        <h1>Delete Database</h1>
        <form action="connection.php" method="post">
            <div class="mb-3">
                <input type="text" name="delete_database" placeholder="Database Name" class="form-control" required>
            </div>
            <button type="submit" name="del-submit" class="btn btn-danger form-control">Submit</button>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>.
    <!-- (Optional) Use CSS or JS implementation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>



<!-- <form action="connection.php" method="post">
    <h1>Delete database</h1>

    <input type="text" name="delete_database" placeholder="database_name">

    submit
    <input type="submit" name="del-submit" value="submit">
</form> -->