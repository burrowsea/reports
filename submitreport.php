<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write Student Report</title>
</head>
<body>
    <h2>Write Student Report</h2>
    <form action="submitreport.php" method="POST">
        <!-- Student Dropdown -->
        <label for="student">Student:</label>
        <select name="student" required>
            <?php
                include_once("connection.php");
                // Get all students
                $stmt = $conn->prepare("SELECT * FROM tblusers WHERE role=0 ORDER BY surname ASC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=".$row['userid'].">".$row['forename']." ".$row['surname']."</option>";
                }
            ?>
        </select><br><br>

        <!-- Subject Dropdown -->
        <label for="subject">Subject:</label>
        <select name="subject" required>
            <?php
                // Get all subjects
                $stmt = $conn->prepare("SELECT * FROM tblsubjects ORDER BY subjectname ASC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=".$row['subjectid'].">".$row['subjectname']."</option>";
                }
            ?>
        </select><br><br>

        <!-- Report Fields -->
        <label for="exammark">Exam Mark:</label>
        <input type="number" name="exammark" min="0" max="100" required><br><br>

        <label for="classgrade">Class Grade:</label>
        <input type="text" name="classgrade" maxlength="1" required><br><br>

        <label for="classposition">Class Position:</label>
        <input type="number" name="classposition" min="1" required><br><br>

        <label for="comment">Comment:</label><br>
        <textarea name="comment" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" value="Submit Report">
    </form>
</body>
</html>

<?php
include_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form
    $student = $_POST['student'];
    $subject = $_POST['subject'];
    $exammark = $_POST['exammark'];
    $classgrade = $_POST['classgrade'];
    $classposition = $_POST['classposition'];
    $comment = $_POST['comment'];

    // Insert the report data into tblpupilstudies
    $stmt = $conn->prepare("INSERT INTO tblpupilstudies (subjectid, userid, classposition, classgrade, exammark, comment) 
                            VALUES (:subject, :student, :classposition, :classgrade, :exammark, :comment)");

    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':student', $student);
    $stmt->bindParam(':classposition', $classposition);
    $stmt->bindParam(':classgrade', $classgrade);
    $stmt->bindParam(':exammark', $exammark);
    $stmt->bindParam(':comment', $comment);

    if ($stmt->execute()) {
        echo "Report submitted successfully.";
    } else {
        echo "Error submitting report.";
    }
}
?>
