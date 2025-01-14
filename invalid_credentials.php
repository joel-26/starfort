<?php
// Check if a message is passed via URL parameter
$message = isset($_GET['message']) ? $_GET['message'] : 'Invalid credentials. Please try again.';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication Error</title>
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

        p.error-message {
            color: #ff0000;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input {
            padding: 10px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            outline: none;
            transition: background-color 0.3s, box-shadow 0.3s;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        input:focus {
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.7);
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

        .footer {
            margin-top: 20px;
            font-size: 1rem;
            transition: color 5s ease-in-out;
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
        <h1>Authentication Failed</h1>
        <p class="error-message"><?php echo htmlspecialchars($message); ?></p>
        <form id="authForm" method="POST" action="authenticate.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Try Again</button>
        </form>
        <div class="footer">
            <p>Powered by <a href="#">StarFort</a> | Secure Authentication</p>
        </div>
    </div>

    <script>
        // Show success or error messages based on URL params
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get("status");

        if (status === "success") {
            alert("✅ Login Successful!");
        } else if (status === "error") {
            alert("❌ Incorrect username or password. Please try again.");
        }
    </script>
</body>
</html>
