<?php
session_start();

function rollOneRound($dice)
{
    $players = $_SESSION['players'];
    foreach ($players as $i => $player) {
        $singleRound = [];
        for ($d = 0; $d < $dice; $d++) {
            $singleRound[] = rand(1, 6);
        }
        $players[$i]['rolls'][] = $singleRound;
    }
    $_SESSION['players'] = $players;
}

// inicializacija
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['1']) && !isset($_SESSION['game_initialized'])) {
    $_SESSION['players'] = [
        ['name' => $_GET['1'] ?? 'Player 1', 'rolls' => []],
        ['name' => $_GET['2'] ?? 'Player 2', 'rolls' => []],
        ['name' => $_GET['3'] ?? 'Player 3', 'rolls' => []]
    ];
    $_SESSION['dice'] = (int) $_GET['dice'];
    $_SESSION['rounds'] = min((int) $_GET['rounds'], 9);
    $_SESSION['current_round'] = 0;
    $_SESSION['game_initialized'] = true;
}

// met kocke
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reroll'])) {
    if ($_SESSION['current_round'] < $_SESSION['rounds']) {
        rollOneRound($_SESSION['dice']);
        $_SESSION['current_round']++;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <title>Lucky 38 Casino - Game</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <link rel="icon" type="image/png" href="img/Lucky38entsign.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
    </style>
</head>

<body>
    <div class="noise-overlay"></div>
    <div class="scanlines-overlay"></div>

    <div id="mainContainer">
        <div id="topContainer" class="animate__animated animate__fadeInDown">
            <img id="titleImg" src="img/Lucky38entsign.png" class="logo-glow">
            <h1 class="neon-title">GAME IN PROGRESS</h1>
            <p class="subtitle">
                ROUND <?= (int) ($_SESSION['current_round'] ?? 0) ?>
                OF <?= (int) ($_SESSION['rounds'] ?? 1) ?>
            </p>
        </div>

        <div class="rounds-wrapper">
            <div id="centerContainer">
                <?php if (!empty($_SESSION['players'])): ?>
                    <?php foreach ($_SESSION['players'] as $player): ?>
                        <div class="player-result">
                            <h2><?= htmlspecialchars($player['name']) ?></h2>
                            <?php if (!empty($player['rolls'])): ?>
                                <?php foreach ($player['rolls'] as $index => $rolls): ?>
                                    <p>Round <?= $index + 1 ?>:
                                        <?php foreach ($rolls as $die): ?>
                                            <span class="dice"><?= $die ?></span>
                                        <?php endforeach; ?>
                                        (Total: <?= array_sum($rolls) ?>)
                                    </p>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No rolls yet</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="button-wrapper">
                    <?php
                    $currentRound = $_SESSION['current_round'] ?? 0;
                    $totalRounds = $_SESSION['rounds'] ?? 1;

                    if ($currentRound < $totalRounds): ?>
                        <form method="post">
                            <input type="submit" id="startButton" name="reroll" value="ROLL DICE">
                        </form>
                    <?php else: ?>
                        <form action="konec.php">
                            <input type="submit" id="startButton" value="VIEW RESULTS">
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</body>

</html>