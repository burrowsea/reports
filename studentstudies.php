<!DOCTYPE html>
<html>
<head>
    
    <title>Users</title>
    
</head>
<body>
    <form action="addstudenttosubject.php" method="POST">
   
    <!--Creates a drop down list-->
    <select name="student">
     <?php
        include_once("connection.php");
        $stmt = $conn->prepare("SELECT * FROM tblusers WHERE role=0 ORDER BY surname ASC");
        $stmt->execute();
        while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                #print_r($row);
                #echo ("<option value=1>John Smith</option>");
                echo("<option value=".$row['userid'].">".$row['forename']." ".$row['surname']."</option>");
            }
     ?>
    </select>
    <select name="subject">
     <?php
        $stmt = $conn->prepare("SELECT * FROM tblsubjects ORDER BY subjectname ASC");
        $stmt->execute();
        while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                #print_r($row);
                #echo ("<option value=1>John Smith</option>");
                echo("<option value=".$row['subjectid'].">".$row['subjectname']."</option>");
            }
     ?>
    </select>
    <input type="submit" value="Add student to subject">
    </form>
  


</body>
</html>