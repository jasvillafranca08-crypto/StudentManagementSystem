
<?php

session_start();

// Initialize student records only once
if (!isset($_SESSION['students'])) {

    $_SESSION['students'] = [
        [
            "id" => "2026-001",
            "name" => "juan dela cruz",
            "course" => "BS Information Technology",
            "year" => "3rd Year",
            "email" => "juan@gmail.com"
        ],
        [
            "id" => "2026-002",
            "name" => "maria santos",
            "course" => "BS Computer Science",
            "year" => "2nd Year",
            "email" => "maria@gmail.com"
        ],
        [
            "id" => "2026-003",
            "name" => "pedro reyes",
            "course" => "BS Information Technology",
            "year" => "1st Year",
            "email" => "pedro@gmail.com"
        ],
        [
            "id" => "2026-004",
            "name" => "ana garcia",
            "course" => "BS Information Technology",
            "year" => "4th Year",
            "email" => "ana@gmail.com"
        ],
        [
            "id" => "2026-005",
            "name" => "mark lopez",
            "course" => "BS Business Administration",
            "year" => "3rd Year",
            "email" => "mark@gmail.com"
        ]
    ];
}

// Use session records throughout the application
$students = &$_SESSION['students'];

// Format student names
function formatName($name) {
    return ucwords(strtolower(trim($name)));
}

// Display student records
function displayStudents($students) {
    foreach ($students as $student) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($student['id']) . "</td>";
        echo "<td>" . htmlspecialchars(formatName($student['name'])) . "</td>";
        echo "<td>" . htmlspecialchars($student['course']) . "</td>";
        echo "<td>" . htmlspecialchars($student['year']) . "</td>";
        echo "<td>" . htmlspecialchars($student['email']) . "</td>";
        echo "</tr>";
    }
}

// Count student records
function countStudents($students) {
    return count($students);
}

?>
