<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signin Page</title>
    <style>
        body{
            padding: 0;
            margin:0;
            text-align: center;
            font-size: 1vw;
        }
        .bg{
            background-image: url("images/reglog-bg.jpg");
            background-size: 100vw;
            background-repeat: no-repeat;
            background-blend-mode: darken;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.3);
            filter: blur(10px);
            z-index: -1;
        }
    /*signin*/
        .signupForm{
            position: absolute;
            top: 5vw;
            width: 30vw;
            height: 30vw;
            margin: 5vw 35vw 20vw 35vw;
            background-color: rgba(255, 245, 221, 0.75);
            border-radius:12px;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, 1));
            overflow: hidden;
        }
        .signupForm::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("images/kapeShop-logo.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            filter: blur(5px); /* Adjust blur level */
            z-index: -1; /* Ensures it stays behind the content */
        }
        .logo{
            position: absolute;
            top:5px;
            left:230px;
            width: 20%;
            height: 20%;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, .5));
        }
        .signupForm h1{
            margin-top: 130px;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, .5));
        }
        .inputForm{
            display: flex;
            width: 75%;
            height: 10%;
            margin: auto;
            margin: 5% auto;
            border-radius:50px;
            background-color: white;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, .5));
        }
        .inputForm img{
            width: 15%;
            height: 100%;
        }
        .inputForm input{
            width: 85%;
            border: none;
            border-radius:50px;
        }
        .signUpBtn{
            width: 75%;
            height: 10%;
            border-radius:12px;
            background-color: rgba(153, 112, 23, 0.75);
            color: white;
            border: none;
            font-size: 1em;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, .5));
            transition: .5s ease;
        }
        .signUpBtn:hover{
            background-color: rgb(255, 255, 255);
            border: 1px solid rgba(153, 112, 23, 0.75);
            color: rgba(153, 112, 23, 0.75);
        }
        .back{
            position: absolute;
            top:0px;
            left:0px;
            width: 10%;
            height: 10%;
            filter: drop-shadow(5px 5px 10px rgba(0, 0, 0, .5));
            transition: .5s ease;
        }
        .back:hover{
            width: 11%;
            height: 11%;
        }
    /*alert*/
        .alert{
            position: absolute;
            top: 120px;
            left:50px;
            color: white;
            width: 20%;
            height: 60px;
            display: none;
            padding-left: 10px;
            border-radius: 20px;
        }
        .alert img{
            width: 100%;
        }
        .alert p{
            width: 85%;
            text-align: left;
        }
        .alert button{
            position: absolute;
            top:15px;
            right: 15px;
            width: 7%;
            padding: 0px;
            line-height: 0;
            border: none;
        }
    /**animation */
        .move-up{
            opacity: 0;
            transform: translateY(50px);
            transition: opacity .5s ease, transform 1s ease; 
        }

        .move-up.visible1 {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="bg"></div>
    <!--alert-->
    <div class="alert move-up" id="alert">
        <p id="alertText">text</p>
        <button id="closeBtn"><img  src="images/icon-close.png"></button>
    </div>
    <!--signin form-->
    <form class="signupForm move-up" id="signupForm">
        <img class="logo move-up" src="images/profile-icon.png">
        <h1 class="move-up">SIGN UP</h1>
        
        <div class="inputForm move-up">
            <img src="images/email-icon.png">
            <input type="email" id="signupEmail" name="signupEmail" placeholder="Email" required>
        </div>
        
        <div class="inputForm move-up">
            <img src="images/password-icon.png">
            <input type="password" id="signupPass" name="signupPass" placeholder="Password" required>
        </div>
        
        <div class="inputForm move-up">
            <img src="images/password-icon.png">
            <input type="password" id="signupConPass" name="signupConPass" placeholder="Confirm Password" required>
        </div>
        
        <button type="submit" class="signUpBtn move-up" onclick="signup(event)" >Sign Up</button>

        <a href="landingPage_index.html">
            <img class="back move-up" src="images/back-icon.png" alt="Back">
        </a>
    </form>

    <?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    $xmlFile = 'userData.xml';
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

    <!-- script -->
    <script>
        //sign up
        function signup(event) {
            event.preventDefault(); // Prevent form from submitting normally

            const email = document.getElementById("signupEmail").value.trim();
            const password = document.getElementById("signupPass").value.trim();
            const confirmPass = document.getElementById("signupConPass").value.trim();

            // Step 1: Check for existing email
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    const xmlDoc = this.responseXML;
                    const users = xmlDoc.getElementsByTagName("user");

                    let emailExists = false;

                    for (let i = 0; i < users.length; i++) {
                        const existingEmail = users[i].getElementsByTagName("email")[0].textContent;
                        if (existingEmail === email) {
                            emailExists = true;
                            break;
                        }
                    }
                    if (emailExists) {
                        showAlert("Email already exists.", "rgb(247, 84, 84)");
                        document.getElementById("signupEmail").value = "";
                    } else if (password !== confirmPass) {
                        showAlert("Passwords do not match.", "rgb(247, 84, 84)");
                        document.getElementById("signupConPass").value = "";
                        document.getElementById("signupPass").value = "";
                    } else {
                        //captcha
                        //email verification
                        //record credentials
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "signupPage.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.onreadystatechange = function () {
                            console.log(xhr.readyState, xhr.status);
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                showAlert("Signup successful! log in your account.", "rgb(36, 221, 67)");
                                document.getElementById("signupForm").reset();
                            }
                        };
                        xhr.send(`email=${email}&password=${password}`);
                    }
                }
            };
            xhttp.open("GET", "userData.xml", true);
            xhttp.send();
        }
        //moveup
        const moveUp = document.querySelectorAll('.move-up');
        const upObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible1');
                }
            });
        }, { threshold: 0.1 });
        moveUp.forEach(el => upObserver.observe(el));
        //alert
        function showAlert(message, bgColor) {
            document.getElementById("alert").style.display = "block";
            document.getElementById("alert").style.backgroundColor = bgColor;
            document.getElementById("alert").style.borderColor = bgColor;
            document.getElementById("closeBtn").style.backgroundColor = bgColor;
            document.getElementById("alertText").innerHTML = message;
            //rgb(247, 84, 84) red
            //rgb(36, 221, 67); green

            // Close functionality
            document.getElementById("closeBtn").addEventListener("click", () => {
                document.getElementById("alert").style.display = "none";
            });
        }
    </script>
</body>
</html>