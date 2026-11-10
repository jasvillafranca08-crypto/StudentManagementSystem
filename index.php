
<?php
require_once 'includes/functions.php';

// Calculate dashboard statistics
$totalStudents = countStudents($students);

$uniqueCourses = array_unique(
    array_column($students, 'course')
);

$uniqueYearLevels = array_unique(
    array_column($students, 'year')
);

$totalCourses = count($uniqueCourses);
$totalYearLevels = count($uniqueYearLevels);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="sidebar">
    <h2>StudentHub</h2>
    <p class="subtitle">Management System</p>

    <nav>
        <a href="index.php" class="active">Dashboard</a>
        <a href="students.php">Student Records</a>
        <a href="add_student.php">Add Student</a>
    </nav>
</div>

<div class="main-content">

    <header>
        <div>
            <h1>Dashboard</h1>
            <p>Welcome to Student Information Management System.</p>
        </div>
        <div class="admin-profile">Administrator</div>
    </header>

    <section class="welcome-card">
        <div>
            <h2>Welcome to StudentHub!</h2>
            <p>Manage and organize student information in one place.</p>
        </div>
    </section>

   
<section class="stats-container">

    <div class="stat-card">
        <div class="stat-icon">👨‍🎓</div>
        <p>Total Students</p>
        <h2><?php echo $totalStudents; ?></h2>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📚</div>
        <p>Available Courses</p>
        <h2><?php echo $totalCourses; ?></h2>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🏫</div>
        <p>Year Levels</p>
        <h2><?php echo $totalYearLevels; ?></h2>
    </div>

</section>


<section class="content-card activity-card">

    <div class="section-heading">
        <div>
            <h2>Recently Registered Students</h2>
            <p>Latest student records added to the system.</p>
        </div>
    </div>

    <div class="activity-list">

        <?php
        $recentStudents = array_slice($students, -3);
        $recentStudents = array_reverse($recentStudents);
        ?>

        <?php if (!empty($recentStudents)): ?>

            <?php foreach ($recentStudents as $student): ?>

                <div class="activity-item">

                    <div class="activity-icon">👤</div>

                    <div class="activity-info">
                        <strong>
                            <?php echo htmlspecialchars(formatName($student['name'])); ?>
                        </strong>

                        <p>
                            <?php echo htmlspecialchars($student['id']); ?>
                            &bull;
                            <?php echo htmlspecialchars($student['course']); ?>
                        </p>
                    </div>

                    <a href="student_details.php?id=<?php echo urlencode($student['id']); ?>"
                       class="activity-view">
                        View
                    </a>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p>No student records available.</p>

        <?php endif; ?>

    </div>

</section>


    <section class="content-card">
        <div class="section-heading">
            <div>
                <h2>Recent Student Records</h2>
                <p>Overview of registered students.</p>
            </div>
            <a href="students.php" class="view-btn">View All</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Email</th>
                    </tr>
                </thead>

                <tbody>
                    <?php displayStudents(array_slice($students, 0, 5)); ?>
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
