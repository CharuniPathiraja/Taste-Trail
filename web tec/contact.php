<?php
session_start();
require_once 'includes/db.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $message])) {
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Something went wrong. Please try again later.";
        }
    }
}

include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row g-5">
        <div class="col-md-6 animate-fade">
            <div class="rounded-4 overflow-hidden mb-4 shadow-sm ratio ratio-16x9">
                <img src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?auto=format&fit=crop&w=800&q=80" class="object-fit-cover" alt="Contact Us">
            </div>
            <h2 class="display-6 font-weight-bold mb-4">Get In Touch</h2>
            <p class="text-muted mb-4">Have questions or want to collaborate? Send us a message and we'll get back to you as soon as possible.</p>
            
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary text-white rounded-circle p-3 me-3">
                    <i class="bi bi-envelope"></i>
                </div>
                <div>
                    <h6 class="mb-0">Email Us</h6>
                    <p class="mb-0 text-muted">support@tastetrail.com</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow p-4 border-0">
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" action="" id="contactForm">
                    <div class="mb-3">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
