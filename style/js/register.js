async function register() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    if (email === "" || password === "") {
        Swal.fire("Error", "Todos los campos son obligatorios", "error");
        return;
    }

    const formData = new FormData();
    formData.append("email", email);
    formData.append("password", password);

    try {
        const response = await fetch("../../../models.register.php", {
            method: "POST",
            body: formData
        });

        const result = await response.json();

        if (result.status === "success") {
            Swal.fire("Éxito", result.message, "success").then(() => {
                window.location.href = "/views/user/login.html"; // Redirige al login
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
    path: '/style/animation/Animation - 1740015401066.json' // Reemplázalo con tu JSON animado
});
