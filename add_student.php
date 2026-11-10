
<?php
require_once 'includes/functions.php';

$errors = [];

$id = '';
$name = '';
$course = '';
$year = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = trim($_POST['id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $course = trim($_POST['course'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $email = trim($_POST['email'] ?? '');

    // Validate required fields
    if ($id === '') {
        $errors[] = "Student ID is required.";
    }

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

    // Check for duplicate student ID
    foreach ($students as $student) {
        if (strcasecmp($student['id'], $id) === 0) {
            $errors[] = "Student ID already exists.";
            break;
        }
    }

    // Add student if no errors
    if (empty($errors)) {

        $students[] = [
            "id" => $id,
            "name" => $name,
            "course" => $course,
            "year" => $year,
            "email" => $email
        ];

        header("Location: students.php?added=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student | StudentHub</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="sidebar">
    <h2>StudentHub</h2>
    <p class="subtitle">Management System</p>

    <nav>
        <a href="index.php">Dashboard</a>
        <a href="students.php">Student Records</a>
        <a href="add_student.php" class="active">Add Student</a>
    </nav>
</div>

<div class="main-content">

    <header>
        <div>
            <h1>Add Student</h1>
            <p>Register a new student in the system.</p>
        </div>

        <div class="admin-profile">Administrator</div>
    </header>

    <section class="content-card form-card">

        <div class="section-heading">
            <div>
                <h2>Student Information</h2>
                <p>Complete all required fields below.</p>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="add_student.php">

            <div class="form-grid">

                <div class="form-group">
                    <label for="id">Student ID</label>
                    <input
                        type="text"
                        id="id"
                        name="id"
                        placeholder="e.g. 2026-006"
                        value="<?php echo htmlspecialchars($id); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Enter full name"
                        value="<?php echo htmlspecialchars($name); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" name="course" required>
                        <option value="">Select Course</option>
                        <option value="BS Information Technology"
                            <?php if ($course === 'BS Information Technology') echo 'selected'; ?>>
                            BS Information Technology
                        </option>
                        <option value="BS Computer Science"
                            <?php if ($course === 'BS Computer Science') echo 'selected'; ?>>
                            BS Computer Science
                        </option>
                        <option value="BS Business Administration"
                            <?php if ($course === 'BS Business Administration') echo 'selected'; ?>>
                            BS Business Administration
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="year">Year Level</label>
                    <select id="year" name="year" required>
                        <option value="">Select Year Level</option>
                        <?php
                        $years = ['1st Year', '2nd Year', '3rd Year', '4th Year'];

                        foreach ($years as $option):
                        ?>
                            <option value="<?php echo $option; ?>"
                                <?php if ($year === $option) echo 'selected'; ?>>
                                <?php echo $option; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="example@gmail.com"
                        value="<?php echo htmlspecialchars($email); ?>"
                        required
                    >
                </div>

            </div>

            <div class="form-actions">
                <a href="students.php" class="cancel-btn">Cancel</a>
                <button type="submit" class="save-btn">
                    Save Student
                </button>
            </div>

        </form>

    </section>

    <footer>
        StudentHub © 2026 | Student Information Management System
    </footer>

</div>

</body>
</html>
