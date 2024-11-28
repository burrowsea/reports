<?php
Add 
include_once("connection.php");
switch($_POST["role"]){
	case "Pupil":
		$role=0;
		break;
	case "Teacher":
		$role=1;
		break;
	case "Admin":
		$role=2;
		break;
}
$stmt->bindParam(':forename', $_POST[“forename”]);
$stmt->bindParam(':surname', $_POST[“surname”]);
$stmt->bindParam(':house', $_POST[“house”]);
$stmt->bindParam(':year', $_POST[“year”]);
$stmt->bindParam(':password', $_POST[“passwd”]);
$stmt->bindParam(':gender', $_POST[“gender”]);
$stmt->bindParam(':role', $role);
$stmt->execute();
$conn=null;
echo $_POST["gender"]."<br>";
echo $_POST["forename"]."<br>";
echo $_POST["surname"]."<br>";
echo $_POST["house"]."<br>";
echo $_POST["year"]."<br>";
echo $_POST["passwd"]."<br>";
echo $_POST["role"]."<br>";
?>