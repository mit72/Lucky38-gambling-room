let timeLeft = 10;

function countdown() {
    const counter = document.getElementById('countdown');
    if (timeLeft <= 0) {
        window.location.href = 'index.php';
    } else {
        counter.textContent = `Returning to main menu in ${timeLeft--}s...`;
        setTimeout(countdown, 1000);
    }
}

window.onload = countdown;