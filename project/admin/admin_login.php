<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Replace 'admin' and 'password' with your actual admin username and password
    $adminUsername = 'developer';
    $adminPassword = 'Developer99!';

    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    if ($enteredUsername === $adminUsername && $enteredPassword === $adminPassword) {

        $_SESSION['admin_logged_in'] = true;
        
        // Redirect to the admin dashboard
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 jumbotron">
                            <h2 style="text-align: center;">
                                Welcome To Admin Login
                                <span style="float: right;"><a href="../index.html" class="btn btn-info">HOME</a></span>
                            </h2>
                    </div>
                </div>
            </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">                    
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
        <button type="submit">Login</button>
            <?php if (isset($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
    </form>
   </div>
</div>
</div>
</body>
</html>
