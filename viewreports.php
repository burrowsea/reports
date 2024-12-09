<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student Reports</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-section {
            margin-bottom: 30px;
            padding: 15px;
            border-radius: 5px;
            background-color: #e9f5ff;
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        select, input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            width: 200px;
        }

        .report-card {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .report-card:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .report-card h3 {
            margin-top: 0;
            font-size: 20px;
            color: #333;
        }

        .report-details {
            font-size: 16px;
            color: #555;
        }

        .report-details p {
            margin: 8px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777;
            background-color: #333;
            color: #fff;
        }

    </style>
</head>
<body>

    <div class="container">
        <h2>View Student Reports</h2>

        <!-- Report Form Section -->
        <div class="form-section">
            <form action="viewreports.php" method="POST">
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
                </select>
                <input type="submit" value="View Reports">
            </form>
        </div>

        <!-- Report Display Section -->
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            echo "<h3>Reports for " . htmlspecialchars($_POST['student']) . ":</h3>";

            $reportCount = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $reportCount++;

                // Generate a card for each report
                echo "<div class='report-card'>
                        <h3>" . htmlspecialchars($row['subjectname']) . "</h3>
                        <div class='report-details'>
                            <p><strong>Exam Mark:</strong> " . htmlspecialchars($row['exammark']) . "</p>
                            <p><strong>Class Grade:</strong> " . htmlspecialchars($row['classgrade']) . "</p>
                            <p><strong>Class Position:</strong> " . htmlspecialchars($row['classposition']) . "</p>
                            <p><strong>Comment:</strong> " . nl2br(htmlspecialchars($row['comment'])) . "</p>
                        </div>
                    </div>";
            }

            // If no reports exist
            if ($reportCount == 0) {
                echo "<p>No reports found for this student.</p>";
            }
        }
        ?>
    </div>

    <div class="footer">
        <p>Super skibidi reports systems &copy; 1837</p>
    </div>

</body>
</html>
