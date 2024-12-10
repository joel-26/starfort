<?php
session_start(); //start session

if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated']) {
    header("Location: auth.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StarFort Email Client</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background-color: black;
            color: white;
        }

        /* Create the background containers for the fading effect */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: -1; /* Ensure it's behind the content */
        }

        /* Define the color palettes */
        .background div {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 2.5s ease-in-out; /* Slightly longer transition */
        }

        /* Darker colors with black */
        .background .dark-grey {
            background: linear-gradient(135deg, #2f2f2f, #000000); /* Dark grey */
        }

        .background .dark-purple {
            background: linear-gradient(135deg, #1e0c2d, #000000); /* Darker purple */
        }

        .background .dark-red {
            background: linear-gradient(135deg, #660000, #000000); /* Darker red */
        }

        .background .dark-blue {
            background: linear-gradient(135deg, #000066, #000000); /* Darker blue */
        }

        /* Container styling */
        .container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            width: 400px;
            text-align: center;
            transition: transform 0.3s;
            z-index: 1; /* Ensure it's on top of the background */
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, textarea {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            outline: none;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        button {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: linear-gradient(90deg, #e63946, #ff4081);
            color: white;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        button:hover {
            background: linear-gradient(90deg, #ff4081, #e63946);
        }

        .success-animation {
            display: none; /* Initially hidden */
            font-size: 1.5rem;
            margin-top: 20px;
            color: #00ff00; /* Highlight for success message */
            position: relative;
            opacity: 0; /* Initially invisible */
            transform: scale(0.5) translateZ(-200px); /* Start far back and scaled down */
            animation: comeFromBack 2s ease-out forwards; /* Apply animation */
        }

        @keyframes comeFromBack {
            0% {
                opacity: 0;
                transform: scale(0.5) translateZ(-200px); /* Starting far and small */
            }
            50% {
                opacity: 0.8;
                transform: scale(1.2) translateZ(-50px); /* Overshooting for emphasis */
            }
            100% {
                opacity: 1;
                transform: scale(1) translateZ(0); /* Final position */
            }
        }

        .footer {
            margin-top: 20px;
            font-size: 1rem;
            color: #888;
        }

        .footer a {
            color: inherit;
            text-decoration: none;
            font-weight: bold;
        }

        /* Adjust animation to make each background color visible */
        @keyframes fadeBackground {
            0% {
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            50% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .background .dark-grey {
            animation: fadeBackground 20s ease-in-out 0s infinite;
        }

        .background .dark-purple {
            animation: fadeBackground 20s ease-in-out 7s infinite;
        }

        .background .dark-red {
            animation: fadeBackground 20s ease-in-out 14s infinite;
        }

        .background .dark-blue {
            animation: fadeBackground 20s ease-in-out 21s infinite;
        }

    </style>
</head>
<body>
    <!-- Background with fading effect -->
    <div class="background">
        <div class="dark-grey"></div>
        <div class="dark-purple"></div>
        <div class="dark-red"></div>
        <div class="dark-blue"></div>
    </div>

    <!-- Main content container -->
    <div class="container">
        <h1>StarFort Email Client</h1>
        <form id="emailForm" method="POST" action="send_email.php">
            <input type="text" name="senderName" placeholder="Sender Name" required>
            <input type="email" name="senderEmail" placeholder="Sender Email" required>
            <input type="email" name="recipient" placeholder="Recipient Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" rows="5" placeholder="Message" required></textarea>
            <button type="submit">Send Email</button>
        </form>
        <div id="success" class="success-animation">✅ Email Sent Successfully!</div>
        <div class="footer">
            <p>Powered by <a href="#">StarFort</a> | Secure & Reliable Email Solutions</p>
            <p><a href="logout.php">Logout</a></p>
        </div>
    </div>

    <script>
        // Show success message after email is sent
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get("status");

        console.log("Status:", status); // Debugging: check the status in the URL

        if (status === "success") {
            document.getElementById("emailForm").style.display = "none";
            const successMessage = document.getElementById("success");
            successMessage.style.display = "block"; // Display the success message
        } else if (status === "error") {
            alert("❌ Failed to send the email. Please try again.");
        }
    </script>
</body>
</html>