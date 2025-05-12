<?php
session_start();

if (!isset($_SESSION['players']) || empty($_SESSION['players'])) {
    echo "<p style='text-align:center; margin-top:50px; color:red;'>No game data found. Please play the game first.</p>";
    echo "<p style='text-align:center;'><a href='index.php'>Go to Start</a></p>";
    exit;
}

// racuna tocke
function getTotalScore($player) {
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

// sortira igralce desc
usort($players, fn($a, $b) => $b['total'] - $a['total']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Over</title>
    <link rel="stylesheet" href="styleKonec.css">
</head>
<body>
    <div id="naslov">
        <h1 class="page-title">Game Over</h1>
    </div>

    <div class="podium">
        <div class="place second">
            <div class="label">2nd</div>
            <div class="info"><?= htmlspecialchars($players[1]['name']) ?><br><?= $players[1]['total'] ?> pts</div>
        </div>
        <div class="place first">
            <div class="label">1st</div>
            <div class="info"><?= htmlspecialchars($players[0]['name']) ?><br><?= $players[0]['total'] ?> pts</div>
        </div>
        <div class="place third">
            <div class="label">3rd</div>
            <div class="info"><?= htmlspecialchars($players[2]['name']) ?><br><?= $players[2]['total'] ?> pts</div>
        </div>
    </div>

    <h2 class="scoreboard-title">Final Scores</h2>
    <table class="scoreboard">
        <tr class="tr-custom-borders">
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
        <button type="submit">Play Again</button>
    </form>
</body>
</html>