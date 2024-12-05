<?php
    include_once("connection.php");
    $stmt = $conn->prepare("SELECT * FROM tblpupilstudies");
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            #print_r($row);
            echo($row["subjectid""]." ".$row[userid"]);
            $stmt1
        }