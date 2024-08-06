const labels = {
   "users.name": "Nombre Usuario",
   "users.email": "Email Usuario",
   "password": "Contraseña",
   "url": "URL Reseteo Contraseña",
   "inmuebles.nombre_inmueble": "Nombre Inmueble",
   "inmuebles.valor_arriendo_venta": "Precio arriendo/venta",
   "inmuebles.created_at" : "Fecha de Creación",
   "inmuebles.id" : "# de Inmueble",
   "categoria" : "Categoría"
};

function initLabels() {
    Object.keys(labels).forEach(key => {
        const button = document.createElement("button");
        button.classList.add("btn", "btn-xs", "btn-success", "m-1");
        button.type = "button";
        button.textContent = labels[key];

        button.addEventListener("click", () => {
            const editorInstance = CKEDITOR.instances['descripcion'];
            if (editorInstance) {
                editorInstance.focus();
                editorInstance.insertHtml(`[[${key}]]`);
            } else {
                console.error("Instancia de CKEditor con ID 'descripcion' no encontrada.");
            }
        });

        button.dataset.key = key;
        const labelsContainer = document.querySelector(".Labels");
        if (labelsContainer) {
            labelsContainer.appendChild(button);
        } else {
            console.error("Elemento con clase 'Labels' no encontrado.");
        }
    });
}

function imgLabels() {
    //Header
    const headerButton = document.createElement("button");
    headerButton.classList.add("btn", "btn-xs", "btn-success", "m-1");
    headerButton.type = "button";
    headerButton.textContent = "IMG encabezado";

    headerButton.addEventListener("click", () => {
        const textarea = document.querySelector(".Labels + textarea");
        const img = `<img src="${document.getElementById("imgHeader").value}">`;
        tinymce.get(textarea.id).selection.setContent(img);
    });

    document.getElementById("headerlabels").appendChild(headerButton);

    //footer
    const footerButton = document.createElement("button");
    footerButton.classList.add("btn", "btn-xs", "btn-success", "m-1");
    footerButton.type = "button";
    footerButton.textContent = "IMG pie de página";

    footerButton.addEventListener("click", () => {
        const textarea = document.querySelector(".Labels + textarea");
        const img = `<img src="${document.getElementById("footerimg").value}">`;
        tinymce.get(textarea.id).selection.setContent(img);
    });

    document.getElementById("footerlabels").appendChild(footerButton);
}

document.addEventListener("DOMContentLoaded", initLabels);

function uploadPreview(content) {
    const payload = new FormData();
    const xhr = new XMLHttpRequest();

    xhr.open("POST", document.getElementById("routeSetPreview").value);
    xhr.setRequestHeader(
        "X-CSRF-Token",
        document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    );

    payload.append("content", content);

    xhr.send(payload);
}