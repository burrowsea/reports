
<!DOCTYPE html>
<html>
<head>
    
    <title>Users</title>
    
</head>
<body>
    <form action="addusers.php" method="POST">
    First name:<input type="text" name="forename"><br>
    Last name:<input type="text" name="surname"><br>
    Password:<input type="password" name="passwd"><br>
    House:<input type="text" name="house"><br>
    Year:<input type="text" name="year"><br>
    <!--Creates a drop down list-->
    Gender:<select name="gender">
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
    <br>
    <!--Next 3 lines create a radio button which we can use to select the user role-->
    <input type="radio" name="role" value="Pupil" checked> Pupil<br>
    <input type="radio" name="role" value="Teacher"> Teacher<br>
    <input type="radio" name="role" value="Admin"> Admin<br>
    <input type="submit" value="Add User">
    </form>
    <h2>Current users</h2>
    <?php
    include_once("connection.php");
    $stmt = $conn->prepare("SELECT * FROM tblusers");
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            #print_r($row);
            echo($row["forename"]." ".$row["surname"]."<br>");
        }

    ?>

</body>
</html>
