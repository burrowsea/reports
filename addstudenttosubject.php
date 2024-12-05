<?php
header('Location:pupilstudies.php');
include_once('connection.php');
array_map("htmlspecialchars", $_POST);
#print_r($_POST);

$stmt = $conn->prepare("INSERT INTO tblpupilstudies (subjectid,userid,classposition,classgrade,exammark,comment)
VALUES (:subjectname,:student,NULL,NULL,NULL,NULL)");
$stmt->bindParam(':subjectname', $_POST["subject"]);
$stmt->bindParam(':student', $_POST["student"]);

$stmt->execute();
?>