<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Student Report</title>
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

        select, input[type="text"], input[type="number"], input[type="submit"], textarea {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        .grade-buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .grade-button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .grade-button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777;
            background-color: #333;
            color: #fff;
        }

        .link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .link a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Submit Student Report</h2>

        
        <div class="link">
            <a href="viewreports.php">View Existing Reports</a>
        </div>

        
        <div class="form-section">
            <form action="submitreport.php" method="POST">
                <label for="student">Select Student:</label>
                <select name="student" required>
                    <?php
                    include_once("connection.php");
                    
                    $stmt = $conn->prepare("SELECT * FROM tblusers WHERE role=0 ORDER BY surname ASC");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=".$row['userid'].">".$row['forename']." ".$row['surname']."</option>";
                    }
                    ?>
                </select>

                <label for="subject">Select Subject:</label>
                <select name="subject" required>
                    <?php
                    
                    $stmt = $conn->prepare("SELECT * FROM tblsubjects ORDER BY subjectname ASC");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=".$row['subjectid'].">".$row['subjectname']."</option>";
                    }
                    ?>
                </select>

                <label for="exammark">Exam Mark:</label>
                <input type="number" name="exammark" required>

                <label for="classposition">Class Position:</label>
                <input type="number" name="classposition" required>

                <label for="classgrade">Class Grade:</label>
                <div class="grade-buttons">
                    <button type="button" class="grade-button" onclick="setGrade('A')">A</button>
                    <button type="button" class="grade-button" onclick="setGrade('B')">B</button>
                    <button type="button" class="grade-button" onclick="setGrade('C')">C</button>
                    <button type="button" class="grade-button" onclick="setGrade('D')">D</button>
                    <button type="button" class="grade-button" onclick="setGrade('E')">E</button>
                    
                </div>

                <input type="hidden" name="classgrade" id="classgrade">
                
                <label for="comment">Comment:</label>
                <textarea name="comment" required></textarea>

                <input type="submit" value="Submit Report">
            </form>
        </div>

        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $student = $_POST['student'];
            $subject = $_POST['subject'];
            $exammark = $_POST['exammark'];
            $classgrade = $_POST['classgrade'];
            $classposition = $_POST['classposition'];
            $comment = $_POST['comment'];

            $stmt = $conn->prepare("UPDATE tblpupilstudies SET classposition=:classposition,  WHERE subjectid=:subject AND userid=:student
             
            ");
            $stmt->bindParam(':subject', $subject);
            $stmt->bindParam(':student', $student);
            $stmt->bindParam(':classposition', $classposition);
            $stmt->bindParam(':classgrade', $classgrade);
            $stmt->bindParam(':exammark', $exammark);
            $stmt->bindParam(':comment', $comment);
            $stmt->execute();

            echo "<p style='color: green; text-align: center;'>Report successfully submitted!</p>";
        }
        ?>
    </div>

    <div class="footer">
        <p>Super skibidi reports systems &copy; 1837</p>
    </div>

    <script>
        function setGrade(grade) {
            document.getElementById('classgrade').value = grade;
        }
    </script>

</body>
</html>
