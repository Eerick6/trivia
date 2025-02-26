// Cargar el nav dinámicamente
fetch("/views/user/nav.html")
    .then(response => response.text())
    .then(html => {
        document.getElementById("nav-container").innerHTML = html;
    })
    .catch(error => console.error("Error al cargar el nav:", error));

// Cargar animación JSON con Lottie
lottie.loadAnimation({
    container: document.getElementById('lottie'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: '/style/animation/Animation - 1740015401066.json' // Reemplázalo con tu JSON animado
});

// Datos de las preguntas (Nivel Difícil)
const questions = [
    {
        question: "¿Qué es un activo?",
        options: [
            "A) Un recurso que tiene valor económico.",
            "B) Una deuda que debe ser pagada.",
            "C) Un gasto operativo."
        ],
        answer: 0 // Índice de la respuesta correcta
    },
    {
        question: "¿Qué es un flujo de efectivo?",
        options: [
            "A) Un informe que muestra las entradas y salidas de efectivo.",
            "B) Un documento que registra las ventas.",
            "C) Un registro de las transacciones bancarias."
        ],
        answer: 0
    },
    {
        question: "¿Qué es un ratio de liquidez?",
        options: [
            "A) Un indicador que mide la capacidad de una empresa para pagar sus deudas.",
            "B) Un documento que registra las compras de activos.",
            "C) Un registro de las transacciones de efectivo."
        ],
        answer: 0
    }
];

let currentQuestionIndex = 0;
let score = 0;
let startTime = Date.now();
let timerInterval;
const level = 'dificil'; // Nivel actual

// Función para mostrar la pregunta actual
function showQuestion() {
    const question = questions[currentQuestionIndex];
    document.getElementById('question-number').textContent = currentQuestionIndex + 1;
    document.getElementById('question-text').textContent = question.question;
    const optionsContainer = document.getElementById('options-container');
    optionsContainer.innerHTML = '';
    question.options.forEach((option, index) => {
        const button = document.createElement('button');
        button.className = 'option';
        button.textContent = option;
        button.addEventListener('click', () => selectAnswer(index));
        optionsContainer.appendChild(button);
    });
}

// Función para manejar la selección de respuestas
function selectAnswer(selectedIndex) {
    const question = questions[currentQuestionIndex];
    if (selectedIndex === question.answer) {
        score++;
        Swal.fire({
            title: '¡Correcto!',
            text: 'Has seleccionado la respuesta correcta.',
            icon: 'success',
            confirmButtonText: 'Siguiente'
        });
    } else {
        Swal.fire({
            title: 'Incorrecto',
            text: 'La respuesta correcta es: ' + question.options[question.answer],
            icon: 'error',
            confirmButtonText: 'Siguiente'
        });
    }

    // Pasar a la siguiente pregunta
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        showQuestion();
    } else {
        endGame();
    }
}

// Función para finalizar el juego
function endGame() {
    const endTime = Date.now();
    const totalTime = Math.floor((endTime - startTime) / 1000); // Tiempo en segundos
    const minutes = Math.floor(totalTime / 60);
    const seconds = totalTime % 60;

    // Obtener los intentos actuales
    const results = JSON.parse(localStorage.getItem(`results-${level}`)) || { score: 0, time: 0, attempts: 0 };
    results.attempts += 1; // Incrementar el contador de intentos

    // Guardar los resultados en localStorage
    results.score = score;
    results.time = totalTime;
    localStorage.setItem(`results-${level}`, JSON.stringify(results));

    Swal.fire({
        title: '¡Juego terminado!',
        html: `
                    <p>Puntuación: ${score} / ${questions.length}</p>
                    <p>Tiempo total: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}</p>
                `,
        icon: 'info',
        confirmButtonText: 'Cerrar'
    }).then(() => {
        // Redirigir al dashboard con los resultados
        window.location.href = `dashboard.html`;
    });
}

// Iniciar el temporizador
function startTimer() {
    const timerElement = document.getElementById('time-left');
    setInterval(() => {
        const currentTime = Math.floor((Date.now() - startTime) / 1000);
        const minutes = Math.floor(currentTime / 60);
        const seconds = currentTime % 60;
        timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
    }, 1000);
}

// Iniciar el juego
showQuestion();
startTimer();
