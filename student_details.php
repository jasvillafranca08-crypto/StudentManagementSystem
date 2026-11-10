
<?php
require_once 'includes/functions.php';

$id = $_GET['id'] ?? '';
$student = null;

// Find student record
foreach ($students as $record) {
    if ($record['id'] === $id) {
        $student = $record;
        break;
    }
}

// Check if student exists
if ($student === null) {
    die("Student record not found. <a href='students.php'>Go back</a>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details | StudentHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="sidebar">
    <h2>StudentHub</h2>
    <p class="subtitle">Management System</p>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="students.php" class="active">Student Records</a>
        <a href="add_student.php">Add Student</a>
    </nav>
</div>

<div class="main-content">

    <header>
        <div>
            <h1>Student Details</h1>
            <p>Complete information about the selected student.</p>
        </div>

        <div class="admin-profile">Administrator</div>
    </header>

    <section class="content-card details-card">

        <div class="section-heading">
            <div>
                <h2>Student Information</h2>
                <p>Student profile and academic information.</p>
            </div>

            <span class="status-label">Registered Student</span>
        </div>

        <div class="student-profile">
            <div class="profile-icon">👤</div>
            <div>
                <h2><?php echo htmlspecialchars(formatName($student['name'])); ?></h2>
                <p><?php echo htmlspecialchars($student['id']); ?></p>
            </div>
        </div>

        <div class="details-grid">

            <div class="detail-item">
                <label>Student ID</label>
                <p><?php echo htmlspecialchars($student['id']); ?></p>
            </div>

            <div class="detail-item">
                <label>Full Name</label>
                <p><?php echo htmlspecialchars(formatName($student['name'])); ?></p>
            </div>

            <div class="detail-item">
                <label>Course</label>
                <p><?php echo htmlspecialchars($student['course']); ?></p>
            </div>

            <div class="detail-item">
                <label>Year Level</label>
                <p><?php echo htmlspecialchars($student['year']); ?></p>
            </div>

            <div class="detail-item full-width">
                <label>Email Address</label>
                <p><?php echo htmlspecialchars($student['email']); ?></p>
            </div>

        </div>

        <div class="form-actions">
            <a href="students.php" class="cancel-btn">Back to Records</a>

            <a href="edit_student.php?id=<?php echo urlencode($student['id']); ?>"
               class="save-btn details-edit-btn">
                Edit Student
            </a>
        </div>

    </section>

    <footer>
        StudentHub © 2026 | Student Information Management System
    </footer>

</div>

</body>
</html>
