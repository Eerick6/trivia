async function login() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    // Verificar si los campos están vacíos
    if (email === "" || password === "") {
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    // Crear un objeto con los datos
    const data = {
        email: email,
        password: password
    };

    try {
        // Realizar la solicitud POST al backend
        const response = await fetch("index.php/login", {
            method: 'POST',
            headers: {
                'Content-Type': "application/json"
            },
            body: JSON.stringify(data)
        });

        // Verificar si la respuesta es correcta
        const result = await response.json();

        // Verificar el estado de la respuesta
        if (result.status === "success") {
            Swal.fire("Éxito", "Bienvenido a Taxation Land", "success").then(() => {
                // Redirigir al dashboard
                window.location.href = 'dashboard'; // Asegúrate de que esta URL sea correcta
            });
        } else {
            Swal.fire("Error", result.message, "error");
        }
    } catch (error) {
        // Manejo de errores en caso de que falle la solicitud
        Swal.fire("Error", "Ocurrió un error al procesar la solicitud", "error");
    }
}


// Cargar animación JSON con Lottie
lottie.loadAnimation({
    container: document.getElementById('lottie'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: 'style/animation/Animation - 1740015401066.json' // Reemplázalo con tu JSON animado
});
