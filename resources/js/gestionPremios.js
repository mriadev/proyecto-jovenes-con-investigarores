import $ from "jquery";

$(document).ready(function () {
    const originalTbodyContent = $("#tbody-tabla-premios").html();
    let tbody = document.querySelector("#tbody-tabla-premios");
    let queryInput = $("#buscar-premio");
    //contar los premios destacados sacandolo del número de filas de la tabla
    let numPremiosDestacados = $("#tbody-tabla-premios-destacados tr").length;
    console.log(numPremiosDestacados);


    function obtenerPremios() {
        let query = queryInput.val().toLowerCase();
        tbody.innerHTML = "";
        return fetch("/obtener-premios-ajax", {
            method: "POST",
            body: JSON.stringify({ query: query }),
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        }).then(function (response) {
            return response.json();
        });
    }



    //Muestra todos los premios en la tabla
    function mostrarPremios() {
        obtenerPremios().then(function (premios) {
            tbody.innerHTML = "";
            // los premios que no son destacados
            premios.forEach(function (premio) {
                if (!premio.destacado) {
                    let fecha = new Date(premio.fecha);
                    let fechaFormateada = `${String(fecha.getDate()).padStart(2, '0')}/${fecha.getMonth() + 1}/${fecha.getFullYear()}`;

                    let rowHtml = `
                    <tr>
                        <td>${premio.titulo}</td>
                        <td>${fechaFormateada}</td>
                        <td>${premio.descripcion}</td>
                        <td>${premio.url}</td>
                        <td>${premio.imagen}</td>
                        <td>
                            <a href="gestion-premios/editar/${premio.id}" class="btn btn-primary btn-editar-premio">Editar</a>
                            <a href="gestion-premios/eliminar/${premio.id}" class="btn btn-danger btn-eliminar-premio">Eliminar</a>
                            ${numPremiosDestacados < 3 ?
                                `<a href="${premio.destacado ? `gestion-premios/quitar-destacado/${premio.id}` : `gestion-premios/destacar/${premio.id}`}" class="btn ${premio.destacado ? "btn-warning" : "btn-success"} btn-destacar-premio">${premio.destacado ? "Quitar destacado" : "Destacar"}</a>`
                                : ''
                            }
                        </td>
                    </tr>
                `;
                    tbody.innerHTML += rowHtml;
                }
            });
        });
    }

    //Muestra los premios que coinciden con la búsqueda
    function mostrarPremiosCoincidentes() {
        obtenerPremios().then(function (premios) {
            tbody.innerHTML = "";

            let premiosFiltrados = premios.filter(function (premio) {
                return premio.titulo.toLowerCase().includes(queryInput.val());
            });
            premiosFiltrados.forEach(function (premio) {
                // formatear la fecha en el formato dd/mm/aaaa
                let fecha = new Date(premio.fecha);
                let fechaFormateada = `${String(fecha.getDate()).padStart(2, '0')}/${fecha.getMonth() + 1}/${fecha.getFullYear()}`;
                
                let rowHtml = `
                <tr>
                    <td>${premio.titulo}</td>
                    <td>${fechaFormateada}</td>
                    <td>${premio.descripcion}</td>
                    <td>${premio.url}</td>
                    <td>${premio.imagen}</td>
                    <td>
                        <a href="gestion-premios/editar/${premio.id}" class="btn btn-primary btn-editar-premio">Editar</a>
                        <a href="gestion-premios/eliminar/${premio.id}" class="btn btn-danger btn-eliminar-premio">Eliminar</a>
                        ${numPremiosDestacados < 3 ?
                            `<a href="${premio.destacado ? `gestion-premios/quitar-destacado/${premio.id}` : `gestion-premios/destacar/${premio.id}`}" class="btn ${premio.destacado ? "btn-warning" : "btn-success"} btn-destacar-premio">${premio.destacado ? "Quitar destacado" : "Destacar"}</a>`
                            : ''
                        }
                    </td>
                </tr>
            `;
                tbody.innerHTML += rowHtml;
            });
        });
    }

    //Muestra todos los premios en la tabla
    mostrarPremios();

    //Muestra los premios que coinciden con la búsqueda
    $("#buscar-premio").on("keyup", function () {
        let query = $(this).val().toLowerCase().trim();

        if (query.length === 0) {
            mostrarPremios();
        } else {
            mostrarPremiosCoincidentes();
        }
    });
});
