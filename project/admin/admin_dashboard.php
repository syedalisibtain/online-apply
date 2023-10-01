<?php
session_start();
require_once '../inc/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

// Initialize sorting and filtering variables
$sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$filterPosition = isset($_GET['filter_position']) ? $_GET['filter_position'] : '';

// Handle sorting
$sortSql = ($sortOrder === 'asc') ? 'ORDER BY city ASC' : 'ORDER BY city DESC';
$nextSortOrder = ($sortOrder === 'asc') ? 'desc' : 'asc';

// Handle filtering by position
$filterSql = '';
if (!empty($filterPosition)) {
    $filterSql = "WHERE position = :position";
}

// Query the database for applicant details with sorting and filtering
$query = "SELECT * FROM applications $filterSql $sortSql";
$stmt = $pdo->prepare($query);

if (!empty($filterPosition)) {
    $stmt->bindParam(':position', $filterPosition, PDO::PARAM_STR);
}

$stmt->execute();
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 jumbotron">
                <h1 style="text-align: center;">Admin Dashboard
                    <span style="float: right;"><a href="admin_logout.php" class="btn btn-danger">Logout</a></span>
                </h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p>Welcome, Admin!</p>

                <!-- Filtering by Position -->
                <form action="admin_dashboard.php" method="get">
                    <div class="form-group">
                        <label for="filter_position">Filter by Position:</label>
                        <select id="filter_position" name="filter_position" class="form-control">
                            <option>Select position</option>
                            <option value="Developer">Developer</option>
                            <option value="HR">HR</option>
                            <option value="SEO">SEO</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <!-- Sorting by City -->
                <table class="table">
                    <thead>
                        <tr>
                            <th><a href="admin_dashboard.php?sort=<?= $nextSortOrder ?>">City</a></th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Email ID</th>
                            <th>Applied for Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $application) : ?>
                            <tr>
                                <td><?php echo $application['city']; ?></td>
                                <td><?php echo $application['first_name']; ?></td>
                                <td><?php echo $application['last_name']; ?></td>
                                <td><?php echo $application['phone']; ?></td>
                                <td><?php echo $application['country']; ?></td>
                                <td><?php echo $application['email']; ?></td>
                                <td><?php echo $application['position']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
