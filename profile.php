<link rel="stylesheet" href="assets/css/css-main.css">
<script src="node_modules\animejs\lib\anime.cjs"></script>
<script src="node_modules\animejs\lib\anime.esm.js"></script>
<script src="node_modules\animejs\lib\anime.esm.min.js"></script>
<script src="node_modules\animejs\lib\anime.iife.js"></script>
<script src="node_modules\animejs\lib\anime.iife.min.js"></script>
<script src="node_modules\animejs\lib\anime.min.cjs"></script>
<script src="node_modules\animejs\lib\anime.umd.js"></script>
<script src="node_modules\animejs\lib\anime.umd.min.js"></script>
<?php include 'navpan.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: linear-gradient(90deg, #1F1C2C, #3f3666);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            padding: 2rem;
        }

        #personal{
            background-color:rgba(76, 27, 101, 0.8)
        }

        .container {
            position: relative;
            width: 100%;
            /* Increased max-width */
            max-width: 1400px;
        }

        .profile-card {
            /* Updated blue glass effect */
            background: rgba(30, 58, 138, 0.1);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 20px;
            width: 100%;
            opacity: 0;
            transform: translateY(20px);
            position: relative;
            z-index: 2;
            border: 1px solid rgba(147, 197, 253, 0.1);
            box-shadow: 0 8px 32px 0 rgba(30, 58, 138, 0.37);
        }

        .section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid rgba(147, 197, 253, 0.2);
        }

        .section-title {
            font-size: 1.2rem;
            /* Updated section title color */
            color: #60a5fa;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }

        .desc {
            margin: -20px;
            text-align: center;
            color:rgb(161, 158, 176);
        }

        .info-grid {
            display: grid;
            /* Updated grid for wider layout */
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .info-item {
            /* Updated info item background */
            background: rgba(59, 130, 246, 0.05);
            padding: 1.5rem;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .info-item:hover {
            transform: translateY(-3px);
            background: rgba(59, 130, 246, 0.1);
        }

        .info-label {
            font-size: 0.9rem;
            color: #60a5fa;
            margin-bottom: 0.5rem;
        }

        .info-value {
            font-size: 1rem;
            color: #fff;
            word-wrap: break-word; 
            overflow-wrap: break-word; 
            white-space: normal; 
        }

        .projects {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .project-card {
            background: rgba(59, 130, 246, 0.05);
            padding: 2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid rgba(147, 197, 253, 0.1);
        }

        .project-card:hover {
            transform: translateY(-5px);
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(147, 197, 253, 0.2);
        }

        .project-title {
            font-size: 1.1rem;
            color: #60a5fa;
            margin-bottom: 0.5rem;
        }

        .project-description {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        .avatar {
            width: 140px;
            height: 140px; 
            background: #3b82f6;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            position: relative;
            overflow: hidden;
            border: 3px solid rgba(147, 197, 253, 0.3);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .social-btn {
            width: 45px;
            height: 45px; 
            border-radius: 50%;
            background: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid rgba(147, 197, 253, 0.2);
        }

        .social-btn:hover {
            transform: translateY(-3px);
            background: #2563eb;
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        }

        .avatar {
            width: 140px; 
            height: 140px; 
            border-radius: 50%;
            overflow: hidden; 
            margin: 0 auto 1.5rem;
            position: relative;
            border: 3px solid rgba(147, 197, 253, 0.3);
        }

        .avatar img {
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            border-radius: 50%; 
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .profile-card {
                padding: 2rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .projects {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="light"></div>
        <div class="light" style="opacity: 0.7;"></div>
        <div class="light" style="opacity: 0.4;"></div>
        <div class="profile-card">
            <div class="section">
                <div class="avatar">
                    <img src="img\mj.jpg" alt="">
                </div>
                <h1 class="name" style="text-align: center; font-size: 2rem; margin-bottom: 0.5rem;">MJ Sanoy</h1>
                <h2 class="title" style="text-align: center; color: #a78bfa; margin-bottom: 1.5rem;">Grade 11 Gates</h2>
                <p class="desc">Tested out this AI called Poe AI wih Claude-3.5-Sonnet to create this simple profile page</p>
            </div>

            <div class="section">
                <h3 class="section-title">Personal Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">School</div>
                        <div class="info-value">Las Piñas City Technical-Vocational High School</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">markjoshua.sanoy@lpctvhs.ph.education</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone</div>
                        <div class="info-value">0965 - 761 - 3884</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Location</div>
                        <div class="info-value">Las Piñas City, Philippines</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3 class="section-title">Personal Projects</h3>
                <div class="projects">
                    <div class="project-card">
                        <h4 class="project-title">Grade 9 Ordering System</h4>
                        <p class="project-description">
                            Developed a ordering system project for the requirements in Grade 9 ICT. 
                            Features include inventory management and order processing.
                        </p>
                    </div>
                    <div class="project-card">
                        <h4 class="project-title">Grade 11 Sales Inventory System</h4>
                        <p class="project-description">
                            Created a sales inventory system for the final project in Grade 11 TVL-ICT. 
                            This project is a simple task with CRUD operations integrated into the system.
                        </p>
                    </div>
                </div>
            </div>

            <div class="social-links">
    <!-- Facebook -->
    <a href="https://www.facebook.com/smmjj.ph/" class="social-btn" target="_blank" rel="noopener noreferrer">
        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
    </a>
    <!-- Instagram -->
    <a href="https://www.instagram.com/mj_sanoy/" class="social-btn" target="_blank" rel="noopener noreferrer">
        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
            <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 1 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
        </svg>
    </a>
    <!-- Threads -->
    <a href="https://www.threads.net/@mj_sanoy" class="social-btn" target="_blank" rel="noopener noreferrer">
        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
            <path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.5 12.06c0-3.587.859-6.476 2.555-8.579C5.865 1.101 8.39 0 11.663 0h.007c3.107.022 5.517 1.011 7.172 2.942.962 1.127 1.552 2.441 1.784 3.589.21 1.036.217 2.135.021 3.168-.226 1.181-.65 2.213-1.262 3.068-.576.803-1.336 1.442-2.262 1.904.72.46 1.315 1.024 1.774 1.685.472.681.787 1.446.935 2.278.149.833.135 1.71-.039 2.613-.205 1.062-.62 2.016-1.233 2.837-.663.89-1.534 1.599-2.587 2.111-1.092.53-2.32.799-3.657.799l-.13.005z"/>
        </svg>
    </a>
    <!-- TikTok -->
    <a href="https://www.tiktok.com/@4mjsanoy" class="social-btn" target="_blank" rel="noopener noreferrer">
        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
            <path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.59-1.15-2.59-2.5 0-1.38 1.16-2.5 2.59-2.5.27 0 .51.04.75.13v-3.31c-.24-.03-.47-.07-.75-.07-3.37 0-6.13 2.73-6.13 6.13 0 3.37 2.73 6.13 6.13 6.13 3.37 0 6.13-2.73 6.13-6.13V9.17c1.03.68 2.39 1.09 3.81 1.09V7.07c-.85.01-1.51-.38-2.19-.86"/>
        </svg>
    </a>
    <!-- X (Twitter) -->
    <a href="https://x.com/MJ_Sanoy4" class="social-btn" target="_blank" rel="noopener noreferrer">
        <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
        </svg>
    </a>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Profile card animation
            anime({
                targets: '.profile-card',
                opacity: [0, 1],
                translateY: [20, 0],
                duration: 1000,
                easing: 'easeOutExpo'
            });

            // Section animations
            anime({
                targets: '.section',
                opacity: [0, 1],
                translateY: [20, 0],
                delay: anime.stagger(200),
                duration: 800,
                easing: 'easeOutQuad'
            });

            // Circling lights animation
            const lights = document.querySelectorAll('.light');
            lights.forEach((light, index) => {
                anime({
                    targets: light,
                    translateX: () => {
                        const radius = 150;
                        return Array(2).fill().map((_, i) => radius * Math.cos(Math.PI * 2 * i));
                    },
                    translateY: () => {
                        const radius = 150;
                        return Array(2).fill().map((_, i) => radius * Math.sin(Math.PI * 2 * i));
                    },
                    rotate: [0, 360],
                    duration: 8000,
                    delay: index * 200,
                    loop: true,
                    easing: 'linear'
                });
            });

            // Social buttons hover animation
            document.querySelectorAll('.social-btn').forEach(btn => {
                btn.addEventListener('mouseenter', () => {
                    anime({
                        targets: btn,
                        scale: 1.1,
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                });

                btn.addEventListener('mouseleave', () => {
                    anime({
                        targets: btn,
                        scale: 1,
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                });
            });
        });
    </script>
</body>
</html>
