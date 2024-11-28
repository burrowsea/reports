<?php
header('Location:subjects.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try{
	include_once('connection.php');
	array_map("htmlspecialchars", $_POST);

	
	$stmt = $conn->prepare("INSERT INTO TblSubjects (SubjectID,Subjectname,Teacher)VALUES (NULL,:subjectname,:teacher)");
	$stmt->bindParam(':subjectname', $_POST["subjectname"]);
	$stmt->bindParam(':teacher', $_POST["teacher"]);

	$stmt->execute();
	}
catch(PDOException $e)
{
    echo "error".$e->getMessage();
}
$conn=null;
?>