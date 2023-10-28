<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Register</h2>
                        <form action="register_process.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="hospital" class="form-label">Choose a hospital name:</label>
                                <input type="text" name="hospital" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Register</button>
                        </form>
                        <p class="mt-3">Already have an account? <a href="index.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
