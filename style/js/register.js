function register() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    if (email === "" || password === "") {
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
    } else {
        Swal.fire("Éxito", "Bienvenido a Taxation Land", "success");
    }
}

// Cargar animación JSON con Lottie
lottie.loadAnimation({
    container: document.getElementById('lottie'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: '/style/animation/Animation - 1740015401066.json' // Reemplázalo con tu JSON animado
});