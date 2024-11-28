<?php
include_once("connection.php");
$stmt = $conn->prepare("DROP TABLE IF EXISTS tblusers;
CREATE TABLE tblusers 
(userid INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
gender VARCHAR(1) NOT NULL,
surname VARCHAR(20) NOT NULL,
forename VARCHAR(20) NOT NULL,
password VARCHAR(20) NOT NULL,
house VARCHAR(20) NOT NULL,
year INT(2) NOT NULL,
role TINYINT(1))"
);
$stmt->execute();
$stmt->closeCursor();
echo("tblusers created");

$stmt = $conn->prepare("DROP TABLE IF EXISTS tblsubjects;
CREATE TABLE tblsubjects
(subjectid INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
subjectname VARCHAR(20) NOT NULL,
teacher VARCHAR(20) NOT NULL)"
);
$stmt->execute();
$stmt->closeCursor();
echo("tblsubjects created");

$stmt = $conn->prepare("DROP TABLE IF EXISTS tblpupilstudies;
CREATE TABLE tblpupilstudies
(subjectid INT(4),
userid INT(4),
classposition INT(2),
classgrade  CHAR(1),
exammark INT(2),
comment TEXT,
PRIMARY KEY(subjectid,userid))"
);
$stmt->execute();
$stmt->closeCursor();
echo("tblpupilstudies created")
?>