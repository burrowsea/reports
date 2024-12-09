<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Student Reports</title>
</head>
<body>
    <h2>View Student Reports</h2>

    <form action="viewreports.php" method="POST">
        <!-- Student Dropdown -->
        <label for="student">Select Student:</label>
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

        <input type="submit" value="View Reports">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get the selected student
        $student = $_POST['student'];

        // Fetch reports for the selected student
        $stmt = $conn->prepare("
            SELECT tblsubjects.subjectname, tblpupilstudies.exammark, tblpupilstudies.classgrade, 
            tblpupilstudies.classposition, tblpupilstudies.comment
            FROM tblpupilstudies
            INNER JOIN tblsubjects ON tblsubjects.subjectid = tblpupilstudies.subjectid
            WHERE tblpupilstudies.userid = :student
        ");
        $stmt->bindParam(':student', $student);
        $stmt->execute();

        // Display the reports
        echo "<h3>Reports for " . $_POST['student'] . ":</h3>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "Subject: " . $row['subjectname'] . "<br>";
            echo "Exam Mark: " . $row['exammark'] . "<br>";
            echo "Class Grade: " . $row['classgrade'] . "<br>";
            echo "Class Position: " . $row['classposition'] . "<br>";
            echo "Comment: " . $row['comment'] . "<br><br>";
        }
    }
    ?>
</body>
</html>
