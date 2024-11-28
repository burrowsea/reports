<?php
header('Location:subjects.php');
include_once('connection.php');
array_map("htmlspecialchars", $_POST);


$stmt = $conn->prepare("INSERT INTO tblsubjects (subjectid,subjectname,teacher)VALUES (NULL,:subjectname,:teacher)");
$stmt->bindParam(':subjectname', $_POST["subjectname"]);
$stmt->bindParam(':teacher', $_POST["teacher"]);

$stmt->execute();
?>