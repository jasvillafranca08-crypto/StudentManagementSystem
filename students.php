
<?php
require_once 'includes/functions.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$filteredStudents = [];

foreach ($students as $student) {
    if (
        stripos($student['id'], $search) !== false ||
        stripos($student['name'], $search) !== false ||
        stripos($student['course'], $search) !== false
    ) {
        $filteredStudents[] = $student;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records | StudentHub</title>
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
            <h1>Student Records</h1>
            <p>View and manage registered student information.</p>
        </div>

        <div class="admin-profile">Administrator</div>
    </header>

    <section class="content-card">

    <?php if (isset($_GET['added'])): ?>
    <div class="success-message">
        Student successfully added!
    </div>

<?php elseif (isset($_GET['updated'])): ?>
    <div class="success-message">
        Student information successfully updated!
    </div>

<?php elseif (isset($_GET['deleted'])): ?>
    <div class="success-message">
        Student successfully deleted!
    </div>
<?php endif; ?>

        <div class="section-heading">
            <div>
                <h2>All Students</h2>
                <p>Manage your student information records.</p>
            </div>

            <a href="add_student.php" class="view-btn">
                + Add Student
            </a>
        </div>
        

        <form method="GET" class="search-form">
            <input
                type="text"
                name="search"
                placeholder="Search by ID, name, or course..."
                value="<?php echo htmlspecialchars($search); ?>"
            >

            <button type="submit">Search</button>

            <a href="students.php" class="reset-btn">Reset</a>
        </form>

        <div class="record-count">
            Showing <?php echo count($filteredStudents); ?>
            of <?php echo countStudents($students); ?> students
        </div>

        <div class="table-container">
            <table>
                <thead>
                   <tr>
                      <th>Student ID</th>
                      <th>Full Name</th>
                      <th>Course</th>
                      <th>Year Level</th>
                      <th>Email Address</th>
                      <th>Actions</th>
                   </tr>
                </thead>

                <tbody>
    <?php if (!empty($filteredStudents)): ?>

        <?php foreach ($filteredStudents as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['id']); ?></td>
                <td><?php echo htmlspecialchars(formatName($student['name'])); ?></td>
                <td><?php echo htmlspecialchars($student['course']); ?></td>
                <td><?php echo htmlspecialchars($student['year']); ?></td>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
                <td>
                    
<div class="action-buttons">

    <a href="student_details.php?id=<?php echo urlencode($student['id']); ?>"
       class="view-details-btn">View</a>

    <a href="edit_student.php?id=<?php echo urlencode($student['id']); ?>"
       class="edit-btn">Edit</a>

    <form action="delete_student.php" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this student?');">

        <input type="hidden" name="id"
               value="<?php echo htmlspecialchars($student['id']); ?>">

        <button type="submit" class="delete-btn">Delete</button>

    </form>

</div>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="6" class="no-records">
                No student records found.
            </td>
        </tr>
    <?php endif; ?>
</tbody>
            </table>
        </div>

    </section>

    <footer>
        StudentHub © 2026 | Student Information Management System
    </footer>

</div>

</body>
</html>
