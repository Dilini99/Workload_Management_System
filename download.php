<?php

require_once 'dompdf/autoload.inc.php';


// Get the URL of the web page you want to download.
$url = "WorkLoad.php";

// Create a new PDF document.
$pdf = new Dompdf();

// Load the HTML content of the web page into the PDF document.
$pdf->loadHtml(file_get_contents($url));

// Set the PDF document's title.
$pdf->setTitle('My Web Page');

// Set the PDF document's author.
$pdf->setAuthor('Your Name');

// Set the PDF document's subject.
$pdf->setSubject('My Web Page');

// Set the PDF document's keywords.
$pdf->setKeywords('my, web, page');

// Save the PDF document to a file.
$pdf->save('my-web-page.pdf');

// Redirect the user to the PDF file.
header('Location: my-web-page.pdf');

?>
