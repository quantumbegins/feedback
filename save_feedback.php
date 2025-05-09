<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = isset($_POST['name']) ? $_POST['name'] : 'Anonymous';
    $email = isset($_POST['email']) ? $_POST['email'] : 'No email provided';
    $project = isset($_POST['project']) ? $_POST['project'] : 'Not specified';
    $message = isset($_POST['message']) ? $_POST['message'] : 'No message';
    
    // Create content for the text file
    $date = date('Y-m-d H:i:s');
    $content = "Feedback submitted on: $date\n\n";
    $content .= "Name: $name\n";
    $content .= "Email: $email\n";
    $content .= "Project: $project\n";
    $content .= "Message:\n$message\n";
    $content .= "----------------------------------------\n";
    
    // Generate a filename based on the current date and user name
    $fileName = "feedback_" . preg_replace('/\s+/', '_', $name) . "_" . date('Ymd_His') . ".txt";
    
    // Save the file in the same directory
    $result = file_put_contents($fileName, $content);
    
    if ($result === false) {
        http_response_code(500);
        echo "Error saving feedback";
    } else {
        http_response_code(200);
        echo "Feedback saved successfully";
    }
} else {
    // Not a POST request
    http_response_code(405);
    echo "Method not allowed";
}
?>