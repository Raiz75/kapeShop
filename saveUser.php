<?php
$email = $_POST['email'];
$password = $_POST['password'];

$xmlFile = 'xmlFiles/userData.xml';
$xml = new DOMDocument();
$xml->preserveWhiteSpace = false; 
$xml->formatOutput = true;
$xml->load($xmlFile);

// Create <profile> node if it doesn't exist
$profileNode = $xml->getElementsByTagName("profile")->item(0);
if (!$profileNode) {
    $profileNode = $xml->createElement("profile");
    $xml->appendChild($profileNode);
}

// Create new <user> node
$newUser = $xml->createElement("user");

// Create the child elements
$emailNode = $xml->createElement("email", $email);
$passwordNode = $xml->createElement("password", $password);
$statusNode = $xml->createElement("status", "active");
$cartNode = $xml->createElement("cart");

// Append children
$newUser->appendChild($emailNode);
$newUser->appendChild($passwordNode);
$newUser->appendChild($statusNode);
$newUser->appendChild($cartNode);
$profileNode->appendChild($newUser);

// Save the updated XML
$xml->save($xmlFile);

// Output success message
echo "Signup successful!";
?>