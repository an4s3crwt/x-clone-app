document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("messageForm");
    const messageInput = document.getElementById("messageInput");
    const messagesContainer = document.getElementById("messagesContainer");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío tradicional del formulario

        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                
                const messageElement = document.createElement("div");
                messageElement.classList.add("p-3", "rounded-lg");
                messageElement.classList.add("bg-gray-300", "text-gray-900", "self-end"); // Mensaje del usuario
                messageElement.textContent = data.message.content;

                messagesContainer.appendChild(messageElement);
                messagesContainer.scrollTop = messagesContainer.scrollHeight; // Desplaza hacia el último mensaje

                messageInput.value = ""; // Limpia el campo de entrada
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
