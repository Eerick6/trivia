async function register() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let username = document.getElementById('username').value; // Obtén el valor del campo username

    // Validación de campos vacíos
    if (email === "" || password === "" || username === "") {
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    // Crear el objeto con los datos
    const data = {
        email: email,
        password: password,
        username: username  // Enviar el campo username
    };

    try {
        const response = await fetch("index.php/register", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"  // Indicamos que los datos son JSON
            },
            body: JSON.stringify(data)  // Convertimos los datos a formato JSON
        });

        // Verificar si la respuesta del servidor es exitosa
        const result = await response.json();

        if (result.status === "success") {
            Swal.fire("Éxito", result.message, "success").then(() => {
                window.location.href = "login"; // Redirige al login
            });
        } else {
            Swal.fire("Error", result.message, "error");
        }
    } catch (error) {
        console.error("Error en el registro:", error);
        Swal.fire("Error", "Hubo un problema con el registro", "error");
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
