<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .nav {
            background-color: #928DAB;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            font-family: 'Lato', sans-serif;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s ease-in-out; /* Add transition for smooth changes */
        }

        .welcome {
            text-align: center;
            padding: 10px 20px;
            background-color: #444;
            color: #FFFFFF; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
        }

        .welcome h1 {
            font-size: 36px;
            font-weight: bold;
        }

        .links {
            display: flex;
            gap: 15px;
            animation: slideIn 0.5s ease-in-out; /* Add slide-in animation */
        }

        .links a {
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background 0.3s, color 0.3s;
            font-family: 'Lato', sans-serif;
            color: white;
        }

        .links a:hover {
            background: rgb(75, 43, 128);
        }

        /* Keyframes for animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Small to Medium Smartphones (320px - 480px) */
        @media (max-width: 480px) {
            .nav {
                padding: 10px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links {
                display: none;
                flex-direction: column;
                background: rgb(100, 95, 128);
                position: absolute;
                top: 60px;
                right: 10px;
                width: 200px;
                border-radius: 5px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease-in-out;
                padding: 10px 15px;
            }

            .links a {
                font-size: 18px;
                text-align: center;
                padding: 10px;
                display: block;
                margin-top: 0px;
                animation: slideIn 0.5s ease-in-out; /* Add slide-in animation */
            }

            .links a:hover {
                background: rgba(48, 18, 84, 0.24);
            }

            .menu-toggle {
                display: block;
                background: none;
                border: none;
                font-size: 28px;
                cursor: pointer;
                color: white;
                padding: 10px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links.show {
                display: flex;
            }

            .welcome {
                margin-left: 120px;
                margin-right: auto;
            }
        }

        /* Tablets & Large Smartphones (481px - 768px) */
        @media (min-width: 481px) and (max-width: 768px) {
            .nav {
                padding: 10px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links {
                display: none;
                flex-direction: column;
                background: rgb(100, 95, 128);
                position: absolute;
                top: 60px;
                right: 10px;
                width: 220px;
                border-radius: 5px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease-in-out;
            }

            .links a {
                font-size: 20px;
                text-align: center;
                padding: 12px;
                display: block;
                animation: slideIn 0.5s ease-in-out; /* Add slide-in animation */
            }

            .links a:hover {
                background: rgba(48, 18, 84, 0.24);
            }

            .menu-toggle {
                display: block;
                background: none;
                border: none;
                font-size: 30px;
                cursor: pointer;
                color: white;
                padding: 10px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links.show {
                display: flex;
            }

            .welcome {
                margin-left: 235px;
                margin-right: auto;
            }
        }

        /* Small Laptops & Tablets (769px - 1024px) */
        @media (min-width: 769px) and (max-width: 1024px) {
            .nav {
                flex-direction: row;
                justify-content: space-between;
                padding: 15px 20px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links {
                display: flex;
                animation: slideIn 0.5s ease-in-out; /* Add slide-in animation */
            }

            .menu-toggle {
                display: none;
            }

            .links a {
                font-size: 18px;
                padding: 10px 15px;
                background: rgba(48, 18, 84, 0.24);
            }
        }

        /* Desktops & Larger Laptops (1025px - 1200px) */
        @media (min-width: 1025px) and (max-width: 1200px) {
            .nav {
                justify-content: space-between;
                padding: 20px 40px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links {
                display: flex;
                animation: slideIn 0.5s ease-in-out; /* Add slide-in animation */
            }

            .menu-toggle {
                display: none;
            }

            .links a {
                font-size: 20px;
                padding: 12px 20px;
                background: rgba(48, 18, 84, 0.24);
            }
        }

        /* Extra Large Screens (1201px and More) */
        @media (min-width: 1201px) {
            .nav {
                justify-content: space-between;
                padding: 20px 40px;
                animation: fadeIn 0.5s ease-in-out; /* Add fade-in animation */
            }

            .links {
                display: flex;
                animation: slideIn 0.5s ease-in-out; /* Add slide-in animation */
            }

            .menu-toggle {
                display: none;
            }

            .links a {
                font-size: 22px;
                padding: 14px 24px;
                background: rgba(48, 18, 84, 0.24);
            }
        }
    </style>
</head>
<body>

    <div class="nav">
        <div class="welcome">
            <h1>SIS-G11</h1>
        </div>

        <!-- Hamburger Menu Button -->
        <button class="menu-toggle">&#9776;</button>

        <!-- Navigation Links -->
        <div class="links">
            <a href="index.php" id="home">Home</a>
            <a href="classification.php" id="classification">Classification</a>
            <a href="storage.php" id="storage">Storage</a>
            <a href="table.php" id="table">View Table</a>
        </div>
    </div>

    <script>
        document.querySelector(".menu-toggle").addEventListener("click", function() {
            document.querySelector(".links").classList.toggle("show");
        });
    </script>

</body>
</html>