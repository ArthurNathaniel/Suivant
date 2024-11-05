<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivant - Welcome</title>
    <?php include 'cdn.php';?>
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
       
    </style>
</head>
<body>

    <div class="container">
        <div class="logo_image">
            <img src="./images/UBA-Logo.png" alt="">
        </div>
        <h1 id="welcomeText">Welcome to Suivant</h1>
        <p id="descriptionText">Efficient Bank Queue Management at Your Fingertips</p>
        <button class="btn" id="startBtn">
            <a href="queue.php">Get Started</a>
        </button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script>
        // Welcome Text Animation
        anime({
            targets: '#welcomeText',
            translateY: [-50, 0],
            opacity: [0, 1],
            duration: 1000,
            easing: 'easeOutExpo',
            delay: 500
        });

        // Description Text Animation
        anime({
            targets: '#descriptionText',
            opacity: [0, 1],
            duration: 1000,
            easing: 'easeOutExpo',
            delay: 1000
        });

        // Button Animation
        anime({
            targets: '#startBtn',
            opacity: [0, 1],
            duration: 1000,
            easing: 'easeOutExpo',
            delay: 1500
        });

        // Button click animation
        document.querySelector('#startBtn').addEventListener('click', function () {
            anime({
                targets: '.container',
                translateY: [-50, -window.innerHeight],
                opacity: [1, 0],
                duration: 1000,
                easing: 'easeInExpo',
                complete: function() {
                    window.location.href = 'nextpage.html';  // Redirect to the next page
                }
            });
        });
    </script>

</body>
</html>
