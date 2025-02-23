// Cargar el nav dinámicamente
fetch("/views/user/nav.html")
    .then(response => response.text())
    .then(html => {
        document.getElementById("nav-container").innerHTML = html;
    })
    .catch(error => console.error("Error al cargar el nav:", error));

// Función para actualizar los resultados en el dashboard
function updateResults() {
    const resultsFacil = JSON.parse(localStorage.getItem('results-facil')) || { score: 0, time: 0, attempts: 0 };
    const resultsMedio = JSON.parse(localStorage.getItem('results-medio')) || { score: 0, time: 0, attempts: 0 };
    const resultsDificil = JSON.parse(localStorage.getItem('results-dificil')) || { score: 0, time: 0, attempts: 0 };

    document.getElementById('score-facil').textContent = resultsFacil.score;
    document.getElementById('time-facil').textContent = formatTime(resultsFacil.time);
    document.getElementById('attempts-facil').textContent = resultsFacil.attempts;

    document.getElementById('score-medio').textContent = resultsMedio.score;
    document.getElementById('time-medio').textContent = formatTime(resultsMedio.time);
    document.getElementById('attempts-medio').textContent = resultsMedio.attempts;

    document.getElementById('score-dificil').textContent = resultsDificil.score;
    document.getElementById('time-dificil').textContent = formatTime(resultsDificil.time);
    document.getElementById('attempts-dificil').textContent = resultsDificil.attempts;
}

// Función para formatear el tiempo en MM:SS
function formatTime(time) {
    const minutes = Math.floor(time / 60);
    const seconds = time % 60;
    return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

// Actualizar los resultados al cargar el dashboard
updateResults();

// Lógica para el modal de selección de nivel
const modal = document.getElementById('level-modal');
const playButton = document.getElementById('play-button');
const closeButton = document.querySelector('.close-button');

playButton.addEventListener('click', () => {
    modal.style.display = 'block'; // Mostrar el modal al hacer clic en "Jugar de nuevo"
});

closeButton.addEventListener('click', () => {
    modal.style.display = 'none'; // Cerrar el modal al hacer clic en la "X"
});

window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = 'none'; // Cerrar el modal si se hace clic fuera de él
    }
}

// Función para seleccionar el nivel
function selectLevel(level) {
    window.location.href = `juego_tri-${level}.html`; // Redirigir al nivel seleccionado
}
