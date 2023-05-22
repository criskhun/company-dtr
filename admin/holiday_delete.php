<?php
include 'includes/session.php';

if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $conn->prepare("DELETE FROM holiday WHERE id = ?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Holiday deleted successfully';
        } else {
            $_SESSION['error'] = $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = 'No holiday ID provided';
    }
} else {
    $_SESSION['error'] = 'Select item to delete first';
}

header('location: holiday.php');
exit();
?>
