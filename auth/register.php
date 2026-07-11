<?php
require_once '../config/database.php';
require_once '../includes/functions.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($fullName === '') {
        $errors[] = 'Full name is required.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    } 
    # email is valid or not

    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if ($password !== $confirmPassword) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $checkQuery = "SELECT id FROM users WHERE email = '$email'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $errors[] = 'This email is already registered.';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO users (full_name, email, phone, password_hash, role) VALUES ('$fullName', '$email', '$phone', '$passwordHash', 'user')";
            
            header('Location: login.php?registered=1');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="mb-3">Create Account</h2>
                        <p class="text-muted">Sign up to access your profile and event dashboard.</p>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if ($success !== ''): ?>
                            <div class="alert alert-success"><?php echo e($success); ?></div>
                        <?php endif; ?>

                        <form method="post" onsubmit="return validateRegisterForm(event)" novalidate>
                            <div class="mb-3">
                                <label class="form-label" for="full_name">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo e($_POST['full_name'] ?? ''); ?>" required>
                                <div class="invalid-feedback" id="full_name_error"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo e($_POST['email'] ?? ''); ?>" required>
                                <div class="invalid-feedback" id="email_error"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" maxlength="10" inputmode="numeric" value="<?php echo e($_POST['phone'] ?? ''); ?>" placeholder="10-digit phone number">
                                <div class="invalid-feedback" id="phone_error"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                <div class="invalid-feedback" id="password_error"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <div class="invalid-feedback" id="confirm_password_error"></div>
                            </div>
                            <div id="register_error" class="alert alert-danger d-none mt-3"></div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>

                        <p class="mt-3 mb-0 text-center">
                            Already have an account? <a href="login.php">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showFieldError(inputId, message) {
            const input = document.getElementById(inputId);
            const errorBox = document.getElementById(inputId + '_error');

            if (!input || !errorBox) {
                return;
            }

            if (message) {
                input.classList.add('is-invalid');
                errorBox.textContent = message;
                errorBox.style.display = 'block';
            } else {
                input.classList.remove('is-invalid');
                errorBox.textContent = '';
                errorBox.style.display = 'none';
            }
        }

        function validateRegisterForm(event) {
            const fullName = document.getElementById('full_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const errorBox = document.getElementById('register_error');

            showFieldError('full_name', '');
            showFieldError('email', '');
            showFieldError('phone', '');
            showFieldError('password', '');
            showFieldError('confirm_password', '');

            const errors = [];

            if (!fullName) {
                errors.push('Full name is required.');
            }

            if (!email) {
                errors.push('Email is required.');
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                errors.push('Please enter a valid email address.');
            }

            if (phone && !/^\d{10}$/.test(phone)) {
                errors.push('Phone number must be exactly 10 digits.');
            }

            if (password.length < 6) {
                errors.push('Password must be at least 6 characters long.');
            }

            if (!confirmPassword) {
                errors.push('Please confirm your password.');
            } else if (password !== confirmPassword) {
                errors.push('Passwords do not match.');
            }

            if (errors.length > 0) {
                if (event) {
                    event.preventDefault();
                }

                errorBox.classList.remove('d-none');
                errorBox.innerHTML = '<ul class="mb-0"><li>' + errors.join('</li><li>') + '</li></ul>';

                if (!fullName) {
                    showFieldError('full_name', 'Full name is required.');
                }
                if (!email) {
                    showFieldError('email', 'Email is required.');
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showFieldError('email', 'Please enter a valid email address.');
                }
                if (phone && !/^\d{10}$/.test(phone)) {
                    showFieldError('phone', 'Phone number must be exactly 10 digits.');
                }
                if (password.length < 6) {
                    showFieldError('password', 'Password must be at least 6 characters long.');
                }
                if (!confirmPassword) {
                    showFieldError('confirm_password', 'Please confirm your password.');
                } else if (password !== confirmPassword) {
                    showFieldError('confirm_password', 'Passwords do not match.');
                }

                return false;
            }

            errorBox.classList.add('d-none');
            errorBox.innerHTML = '';
            return true;
        }
    </script>
</body>
</html>
