<?php

$name = "";
$email = "";
$subject = "";
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['message']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "admission_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute SQL query
    if ($stmt->execute()) {
        echo '<script>alert("Message sent successfully!")</script>';
        // Reset form fields after successful submission
        $name = "";
        $email = "";
        $subject = "";
        $message = "";
    } else {
        echo '<script>alert("Error: ' . $stmt->error . '")</script>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>





<!-- container -->
    <div class="container" style="padding-top: 55px;">
        <div class="row justify-content-center">
            <div class="col-12">
                <img src="./assets/contact.jpg" class="img-fluid" alt="Responsive image">
            </div>
        </div>

        <div class="row justify-content-center" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="col-12">
                <h2 class="text-center" style="padding-bottom: 20px;">AMS | Contact Us</h2>
                <p class="text-center">At our Admission Management System (AMS), we are committed to providing you with the best support and
                    assistance possible. Whether you have questions about the application process, need help navigating
                    our system, or have any other concerns, our dedicated team is here to help. Please don't hesitate to
                    reach out to us at any time. Your success is our priority, and we are here to ensure that your
                    admission experience is smooth and hassle-free. Contact us today and let us assist you in your
                    academic journey.</p>
            </div>
        </div>

        <div class="row justify-content-center border-top border-primary">
            <div class="col-md-6" style="padding-top: 50px; padding-bottom: 50px;">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-bottom: 20px;">Contact Information</h5>
                        <p><strong class="text-muted">Address: </strong> 123 College Road, City, State, ZIP<br />
                            <strong class="text-muted">Phone: </strong><a href="tel:+1234567980" class="text-dark" style="text-decoration: none;">+12 345 67 980</a><br />
                            <strong class="text-muted">Email: </strong><a href="mailto:support@admissionmanagement.com" class="text-dark" style="text-decoration: none;">support@admissionmanagement.com</a>
                        </p>
                        <p style="margin-top: 30px;"><strong>Follow us on:</strong>
                            <div class="d-flex justify-content-start">
                                <a href="#!" class="nav-link" style="padding-right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg> Facebook
                                </a>
                                <a href="#!" class="nav-link" style="padding-right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                                    </svg> Twitter
                                </a>
                                <a href="#!" class="nav-link" style="padding-right: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                    </svg> Linkedin
                                </a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="padding-top: 50px; padding-bottom: 50px;">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-bottom: 20px;">Our Location</h5>
                        <iframe src="https://www.google.com/maps/embed?pb=YOUR_EMBED_URL" width="100%" height="450"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center border-top border-primary" style="margin-bottom: 40px;">
            <div class="col-8" style="padding-top: 5px; margin-top: 40px;">
                <div class="card" style="width: 100%;">
                    <div class="card-body" style="background-color: rgb(208, 219, 232);">
                        <h4 class="text-center">Send Us a Message</h4>
                        <form method="POST" action="">
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="name" style="padding-bottom: 2px;">Name with initials</label>
                                <input type="text" class="form-control" name="name" placeholder="Ex: (A. B. Perera)" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="email" style="padding-bottom: 2px;">Email address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="subject" style="padding-bottom: 2px;">Subject</label>
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 8px;">
                                <label for="message" style="padding-bottom: 2px;">Message</label>
                                <textarea id="message" class="form-control" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 5px; margin-bottom: 10px;">Submit</button>
                        </form>
                    </div>
                </div>    
            </div>
        </div>  
    </div>
<!-- container -->