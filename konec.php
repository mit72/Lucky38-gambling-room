<?php
session_start();

if (!isset($_SESSION['players']) || empty($_SESSION['players'])) {
    echo "<p style='text-align:center; margin-top:50px; color:red;'>No game data found. Please play the game first.</p>";
    echo "<p style='text-align:center;'><a href='index.php'>Go to Start</a></p>";
    exit;
}

function getTotalScore($player)
{
    $sum = 0;
    foreach ($player['rolls'] as $round) {
        $sum += array_sum($round);
    }
    return $sum;
}

$players = $_SESSION['players'];
foreach ($players as &$player) {
    $player['total'] = getTotalScore($player);
}
unset($player);

usort($players, fn($a, $b) => $b['total'] - $a['total']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <title>Lucky 38 Casino - Results</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'>
    <link rel="icon" type="image/png" href="img/Lucky38entsign.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>
    <div class="noise-overlay"></div>
    <div class="scanlines-overlay"></div>

    <div id="mainContainer">
        <div id="topContainer" class="animate__animated animate__fadeInDown">
            <img id="titleImg" src="img/Lucky38entsign.png" class="logo-glow">
            <h1 class="neon-title">GAME RESULTS</h1>
            <p class="subtitle">FINAL SCORES</p>
        </div>

        <div id="centerContainer">
            <div class="podium">
                <div class="place second">
                    <div class="label">2nd</div>
                    <div class="info"><?= htmlspecialchars($players[1]['name']) ?><br><?= $players[1]['total'] ?> pts
                    </div>
                </div>
                <div class="place first">
                    <div class="label">1st</div>
                    <div class="info"><?= htmlspecialchars($players[0]['name']) ?><br><?= $players[0]['total'] ?> pts
                    </div>
                </div>
                <div class="place third">
                    <div class="label">3rd</div>
                    <div class="info"><?= htmlspecialchars($players[2]['name']) ?><br><?= $players[2]['total'] ?> pts
                    </div>
                </div>
            </div>

            <table class="scoreboard">
                <tr>
                    <th>Player</th>
                    <th>Total Points</th>
                </tr>
                <?php foreach ($players as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= $p['total'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <form method="post" action="index.php" class="reset-form">
                <button type="submit">PLAY AGAIN</button>
            </form>

            <p id="countdown" style="color: rgba(224, 191, 72, 0.9); font-size: 1.2rem; text-align: center; margin-top: 20px;">
                Returning to main menu in 10s...
            </p>
        </div>
    </div>
    <script src="js/javascript.js"></script>
</body>

</html>