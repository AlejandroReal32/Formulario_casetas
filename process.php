<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect all form data
    $formData = array(
        'sitio_inspeccion' => array(
            'firstName' => $_POST['firstName'] ?? '',
            'lastName' => $_POST['lastName'] ?? '',
            'dob' => $_POST['dob'] ?? '',
            'gender' => $_POST['gender'] ?? ''
        ),
        'info_general' => array(
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'address' => $_POST['address'] ?? '',
            'city' => $_POST['city'] ?? '',
            'zip' => $_POST['zip'] ?? ''
        ),
        'info_mercancia' => array(
            'highestDegree' => $_POST['highestDegree'] ?? '',
            'institution' => $_POST['institution'] ?? '',
            'fieldOfStudy' => $_POST['fieldOfStudy'] ?? '',
            'graduationYear' => $_POST['graduationYear'] ?? ''
        ),
        'info_carga' => array(
            'currentJob' => $_POST['currentJob'] ?? '',
            'company' => $_POST['company'] ?? '',
            'industry' => $_POST['industry'] ?? '',
            'yearsExperience' => $_POST['yearsExperience'] ?? '',
            'skills' => $_POST['skills'] ?? ''
        ),
        'incumplimiento_federal' => array(
            'interests' => $_POST['interests'] ?? '',
            'references' => $_POST['references'] ?? '',
            'additionalInfo' => $_POST['additionalInfo'] ?? '',
            'terms' => isset($_POST['terms']) ? 'Agreed' : 'Not agreed'
        ),
        'incumplimiento_estatal' => array(
            'interests' => $_POST['interests'] ?? '',
            'references' => $_POST['references'] ?? '',
            'additionalInfo' => $_POST['additionalInfo'] ?? '',
            'terms' => isset($_POST['terms']) ? 'Agreed' : 'Not agreed'
        ),
        'DECA' => array(
            'interests' => $_POST['interests'] ?? '',
            'references' => $_POST['references'] ?? '',
            'additionalInfo' => $_POST['additionalInfo'] ?? '',
            'terms' => isset($_POST['terms']) ? 'Agreed' : 'Not agreed'
        )
    );

    // You can process the data here (save to database, send email, etc.)
    // For this example, we'll just display the collected data

    // Start HTML output
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Submission Result</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="form-container">
            <h1>Form Submission Successful</h1>
            <p>Thank you for submitting your information. Here's what we received:</p>';
    
    // Display the collected data
    foreach ($formData as $tabName => $fields) {
        echo '<div class="tabcontent" style="display: block; margin-bottom: 20px;">
                <h2>' . ucfirst($tabName) . ' Information</h2>
                <table>';
        
        foreach ($fields as $fieldName => $value) {
            echo '<tr>
                    <td><strong>' . ucfirst(str_replace('_', ' ', $fieldName)) . ':</strong></td>
                    <td>' . htmlspecialchars($value) . '</td>
                  </tr>';
        }
        
        echo '</table></div>';
    }
    
    // End HTML output
    echo '</div></body></html>';
    
    // Optionally, save to a file or database
    // file_put_contents('form_submissions.txt', print_r($formData, true), FILE_APPEND);
} else {
    // Not a POST request, redirect to form
    header("Location: index.html");
    exit();
}
?>