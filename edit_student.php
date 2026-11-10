
<?php
require_once 'includes/functions.php';

$id = $_GET['id'] ?? '';
$studentIndex = null;

// Find student using Student ID
foreach ($students as $index => $student) {
    if ($student['id'] === $id) {
        $studentIndex = $index;
        break;
    }
}

if ($studentIndex === null) {
    die("Student record not found. <a href='students.php'>Go back</a>");
}

$student = $students[$studentIndex];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($name === '') {
        $errors[] = "Student name is required.";
    }

    if ($course === '') {
        $errors[] = "Please select a course.";
    }

    if ($year === '') {
        $errors[] = "Please select a year level.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($errors)) {

        $students[$studentIndex] = [
            "id" => $student['id'],
            "name" => $name,
            "course" => $course,
            "year" => $year,
            "email" => $email
        ];

        header("Location: students.php?updated=1");
        exit;
    }

    $student['name'] = $name;
    $student['course'] = $course;
    $student['year'] = $year;
    $student['email'] = $email;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | StudentHub</title>
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
            <h1>Edit Student</h1>
            <p>Update the selected student's information.</p>
        </div>

        <div class="admin-profile">Administrator</div>
    </header>

    <section class="content-card form-card">

        <div class="section-heading">
            <div>
                <h2>Student Information</h2>
                <p>Modify the information below.</p>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="edit_student.php?id=<?php echo urlencode($student['id']); ?>">

            <div class="form-grid">

                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text"
                           value="<?php echo htmlspecialchars($student['id']); ?>"
                           disabled>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name"
                           value="<?php echo htmlspecialchars($student['name']); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" name="course" required>
                        <?php
                        $courses = [
                            'BS Information Technology',
                            'BS Computer Science',
                            'BS Business Administration'
                        ];

                        foreach ($courses as $option):
                        ?>
                            <option value="<?php echo htmlspecialchars($option); ?>"
                                <?php echo ($student['course'] === $option) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($option); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="year">Year Level</label>
                    <select id="year" name="year" required>
                        <?php
                        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];

                        foreach ($years as $option):
                        ?>
                            <option value="<?php echo $option; ?>"
                                <?php echo ($student['year'] === $option) ? 'selected' : ''; ?>>
                                <?php echo $option; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                           value="<?php echo htmlspecialchars($student['email']); ?>"
                           required>
                </div>

            </div>

            <div class="form-actions">
                <a href="students.php" class="cancel-btn">Cancel</a>
                <button type="submit" class="save-btn">Update Student</button>
            </div>

        </form>
    </section>

    <footer>
        StudentHub © 2026 | Student Information Management System
    </footer>

</div>

</body>
</html>
