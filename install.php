<?php
include_once("connection.php");
$stmt = $conn->prepare("DROP TABLE IF EXISTS tblusers;
CREATE TABLE tblusers 
(UserID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
gender VARCHAR(1) NOT NULL,
surname VARCHAR(20) NOT NULL,
forename VARCHAR(20) NOT NULL,
password VARCHAR(20) NOT NULL,
house VARCHAR(20) NOT NULL,
year INT(2) NOT NULL,
role TINYINT(1))");
$stmt->execute();
$stmt->closeCursor();
echo("tblusers created")
$stmt = $conn->prepare("DROP TABLE IF EXISTS tblsubjects;
CREATE TABLE tblsubjects
(subjectID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
subjectname VARCHAR(20) NOT NULL,
teacher VARCHAR(20) NOT NULL);");
$stmt->execute();
$stmt->closeCursor();
echo("tblusers created")
?>





CREATE TABLE TblSubjects(SubjectID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Subjectname VARCHAR(20) NOT NULL,
Teacher VARCHAR(20) NOT NULL);



CREATE TABLE TblPupilStudies(Subjectid INT(4),
Userid INT(4),
Classposition INT(2),
Classgrade  CHAR(1),
Exammark INT(2),
Comment TEXT,
PRIMARY KEY(Subjectid,Userid));