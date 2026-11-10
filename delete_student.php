
<?php

require_once 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? '';

    foreach ($students as $index => $student) {

        if ($student['id'] === $id) {

            unset($students[$index]);

            // Reorganize array indexes
            $students = array_values($students);

            header("Location: students.php?deleted=1");
            exit;
        }
    }
}

header("Location: students.php");
exit;

?>
