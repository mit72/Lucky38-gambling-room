<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <title>Lucky 38 Casino</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <link rel="icon" type="image/png" href="img/Lucky38entsign.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="noise-overlay"></div>
    <div class="scanlines-overlay"></div>

    <form action="igraj.php" method="GET">
        <div id="mainContainer">
            <div id="topContainer" class="animate__animated animate__fadeInDown">
                <img id="titleImg" src="img/Lucky38entsign.png" class="logo-glow">
                <h1 class="neon-title">LUCKY 38 CASINO</h1>
                <p class="subtitle">EST. 2281 • NEW VEGAS</p>
            </div>

            <div id="centerContainer">
                <div id="playerCenterContainer">
                    <div class="player animate__animated animate__fadeInLeft">
                        <label>Player 1:</label>
                        <input id="1" name="1" class="textInput" type="text" placeholder="Enter name" required>
                        <div class="input-glow"></div>
                    </div>
                    <div class="player animate__animated animate__fadeInLeft">
                        <label>Player 2:</label>
                        <input id="2" name="2" class="textInput" type="text" placeholder="Enter name" required>
                        <div class="input-glow"></div>
                    </div>
                    <div class="player animate__animated animate__fadeInLeft">
                        <label>Player 3:</label>
                        <input id="3" name="3" class="textInput" type="text" placeholder="Enter name" required>
                        <div class="input-glow"></div>
                    </div>
                </div>

                <div id="gameSettingsContainer" class="animate__animated animate__fadeInRight">
                    <label for="dice">Number of Dice (1-5):</label>
                    <input id="dice" name="dice" type="number" min="1" max="5" value="1" required>
                    <br>
                    <label for="rounds">Number of Rounds (1-9):</label>
                    <input id="rounds" name="rounds" type="number" min="1" max="9" value="1" required>
                </div>
            </div>

            <div id="bottomContainer" class="animate__animated animate__fadeInUp">
                <input class="startButton" type="submit" value="Begin Game"></input>
            </div>
        </div>
    </form>
</body>

</html>
