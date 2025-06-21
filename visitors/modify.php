<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
require_once 'db.php';

$visitor = null;
$error = '';
$id = 0;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} elseif (isset($_POST['id'])) {
    $id = intval($_POST['id']);
} else {
     $error = "No visitor ID provided.";
}

if ($id > 0) {
    $result = $conn->query("SELECT * FROM visitors WHERE id=$id");
    if ($result->num_rows > 0) {
        $visitor = $result->fetch_assoc();
    } else {
        $error = "Visitor not found.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id > 0) {
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $purpose = $conn->real_escape_string($_POST['purpose']);
    $department = $conn->real_escape_string($_POST['department']);
    
    $sql = "UPDATE visitors SET name='$name', address='$address', phone='$phone', purpose='$purpose', department='$department' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Visitor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Modify Visitor</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
        <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    <?php elseif ($visitor): ?>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $visitor['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($visitor['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($visitor['address']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($visitor['phone']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose of Visit</label>
            <input type="text" class="form-control" id="purpose" name="purpose" value="<?php echo htmlspecialchars($visitor['purpose']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="department" class="form-label">Department</label>
            <input type="text" class="form-control" id="department" name="department" value="<?php echo htmlspecialchars($visitor['department']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Visitor</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $conn->close(); ?> 