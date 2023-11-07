function selectorModo() {
    var modoSeleccionado = document.querySelector('input[name="modoSel"]:checked').value;
    let imagen;
    let descripcion;
    let titulo;
    switch (modoSeleccionado) {
        case "goles":
            titulo = "GOLES";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha anotado más goles a lo largo de su carrera.";
            imagen = "img/modo_goles";
            break;

        case "asistencias":
            titulo = "ASISTENCIAS";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha dado más asistencias a lo largo de su carrera.";
            imagen = "img/modo_asistencias";
            break;

        case "valor":
            titulo = "VALOR";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha tenido un mayor valor de mercado.";
            imagen = "img/modo_valor";
            break;
        
        case "partidos":
            titulo = "PARTIDOS";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha jugado más partidos a lo largo de su carrera.";
            imagen = "img/modo_partidos";
            break;
    }
    let docImagen = document.getElementById("modoImagen");
    let docTitulo = document.getElementById("modoTitulo");
    let docDescripcion = document.getElementById("modoDescripcion");
    let contenedor = document.getElementById("imagen");
    let contenedor2 = document.getElementById("texto");
    contenedor.removeChild(docImagen);
    contenedor2.removeChild(docTitulo);
    contenedor2.removeChild(docDescripcion);
    docImagen = document.createElement("img");
    docTitulo = document.createElement("h4");
    docDescripcion = document.createElement("p");
    docImagen.setAttribute("src",imagen+".png");
    docImagen.setAttribute("alt","image");
    docImagen.setAttribute("id","modoImagen");
    docTitulo.setAttribute("id","modoTitulo");
    docTitulo.textContent = titulo;
    docDescripcion.textContent = descripcion;
    docDescripcion.setAttribute("id","modoDescripcion");
    contenedor2.appendChild(docTitulo);
    contenedor2.appendChild(docDescripcion);
    contenedor.appendChild(docImagen);    
}


