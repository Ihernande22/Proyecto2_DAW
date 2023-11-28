function selectorModo() {
    let modoSeleccionado = document.querySelector('input[name="modoSel"]:checked').value;
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


function toggleLogin(mostrarLogin) {
    var formulario = document.getElementById("formularioLogin");
    var containerFormulario = document.getElementById("containerLogin");
    if (!mostrarLogin) {
        containerFormulario.style.display = "none";
        formulario.style.display = "none";
    }
    else {
        containerFormulario.style.display = "flex";
        containerFormulario.style.flexDirection = "column";
        formulario.style.display = "flex";
        formulario.style.flexDirection = "column";
    }
}

toggleLogin(false);

function crearInterfazConfigPartida() {
    let modoSeleccionado = document.querySelector('input[name="modoSel"]:checked').value;

    //Eliminar el container con el selector de modo
    var containerModos = document.getElementById("container_modos");
    containerModos.parentNode.removeChild(containerModos);

    //Crear boton para volver Atras
    var volverAtras = document.createElement("div");
    var volverAtrasBoton = document.createElement("button");
    var volverAtrasImg = document.createElement("img");
    volverAtras.setAttribute("id", "volverAtras");
    volverAtrasImg.setAttribute("src","img/volverAtras.png")
    volverAtrasImg.setAttribute("alt", "image");
    volverAtrasBoton.appendChild(volverAtrasImg);
    volverAtrasBoton.addEventListener("click", function() {
        var containerEliminar = document.getElementById("principal");
        if (containerEliminar) {
            document.body.removeChild(containerEliminar);
            document.body.removeChild(volverAtras);
            document.body.appendChild(containerModos);
        }
    })
    volverAtras.appendChild(volverAtrasBoton);

    //Crear Estructura HTML de la configuracion de liga y dificultad
    var Principal = document.createElement("div");
    Principal.setAttribute("class", "principal");
    Principal.setAttribute("id", "principal");

    var ContenedorLigas = document.createElement("div");
    ContenedorLigas.setAttribute("class", "ligas");

    var ContenedorDificultades = document.createElement("div");
    ContenedorDificultades.setAttribute("class", "dificultades");

    var TituloLigas = document.createElement("h1");
    TituloLigas.textContent = "SELECCIONA UNA LIGA";
    
    var TituloDificultades = document.createElement("h1");
    TituloDificultades.textContent = "SELECCIONA UNA DIFICULTAD";

    var SelectorLigas = document.createElement("p");
    SelectorLigas.setAttribute("id", "liga");

    var SelectorDificultades = document.createElement("p");
    SelectorDificultades.setAttribute("id", "dificultad");

    //Ligas
    //LaLiga
    var labelLiga1 = document.createElement("label");
    var inputLiga1 = document.createElement("input");
    inputLiga1.setAttribute("type", "radio");
    inputLiga1.setAttribute("name", "liga");
    inputLiga1.setAttribute("value", "laliga");
    var spanLiga1 = document.createElement("span");
    var imgLiga1 = document.createElement("img");
    imgLiga1.setAttribute("src", "img/ligas/laliga.png");
    imgLiga1.setAttribute("alt", "image");
    spanLiga1.appendChild(imgLiga1);
    labelLiga1.appendChild(inputLiga1);
    labelLiga1.appendChild(spanLiga1);

    //Premier League
    var labelLiga2 = document.createElement("label");
    var inputLiga2 = document.createElement("input");
    inputLiga2.setAttribute("type", "radio");
    inputLiga2.setAttribute("name", "liga");
    inputLiga2.setAttribute("value", "premier");
    var spanLiga2 = document.createElement("span");
    var imgLiga2 = document.createElement("img");
    imgLiga2.setAttribute("src", "img/ligas/premier_league.png");
    imgLiga2.setAttribute("alt", "image");
    spanLiga2.appendChild(imgLiga2);
    labelLiga2.appendChild(inputLiga2);
    labelLiga2.appendChild(spanLiga2);

    //Bundesliga
    var labelLiga3 = document.createElement("label");
    var inputLiga3 = document.createElement("input");
    inputLiga3.setAttribute("type", "radio");
    inputLiga3.setAttribute("name", "liga");
    inputLiga3.setAttribute("value", "bundesliga");
    var spanLiga3 = document.createElement("span");
    var imgLiga3 = document.createElement("img");
    imgLiga3.setAttribute("src", "img/ligas/bundesliga.png");
    imgLiga3.setAttribute("alt", "image");
    spanLiga3.appendChild(imgLiga3);
    labelLiga3.appendChild(inputLiga3);
    labelLiga3.appendChild(spanLiga3);

    //Serie A
    var labelLiga4 = document.createElement("label");
    var inputLiga4 = document.createElement("input");
    inputLiga4.setAttribute("type", "radio");
    inputLiga4.setAttribute("name", "liga");
    inputLiga4.setAttribute("value", "serieA");
    var spanLiga4 = document.createElement("span");
    var imgLiga4 = document.createElement("img");
    imgLiga4.setAttribute("src", "img/ligas/seriea.png");
    imgLiga4.setAttribute("alt", "image");
    spanLiga4.appendChild(imgLiga4);
    labelLiga4.appendChild(inputLiga4);
    labelLiga4.appendChild(spanLiga4);

    //Aleatorio
    var labelLiga5 = document.createElement("label");
    var inputLiga5 = document.createElement("input");
    inputLiga5.setAttribute("type", "radio");
    inputLiga5.setAttribute("name", "liga");
    inputLiga5.setAttribute("value", "aleatorio");
    var spanLiga5 = document.createElement("span");
    var imgLiga5 = document.createElement("img");
    imgLiga5.setAttribute("src", "img/ligas/aleatorio.png");
    imgLiga5.setAttribute("alt", "image");
    spanLiga5.appendChild(imgLiga5);
    labelLiga5.appendChild(inputLiga5);
    labelLiga5.appendChild(spanLiga5);

    //Añadir elementos de liga a su contenedor
    SelectorLigas.appendChild(labelLiga1);
    SelectorLigas.appendChild(labelLiga2);
    SelectorLigas.appendChild(labelLiga3);
    SelectorLigas.appendChild(labelLiga4);
    SelectorLigas.appendChild(labelLiga5);

    ContenedorLigas.appendChild(TituloLigas);
    ContenedorLigas.appendChild(SelectorLigas);

    //Dificultades
    //Normal
    var labelDif1 = document.createElement("label");
    var inputDif1 = document.createElement("input");
    inputDif1.setAttribute("type", "radio");
    inputDif1.setAttribute("name", "dificultad");
    inputDif1.setAttribute("value", "normal");
    var spanDif1 = document.createElement("span");
    spanDif1.textContent = "NORMAL";
    labelDif1.appendChild(inputDif1);
    labelDif1.appendChild(spanDif1);

    //Dificil
    var labelDif2 = document.createElement("label");
    var inputDif2 = document.createElement("input");
    inputDif2.setAttribute("type", "radio");
    inputDif2.setAttribute("name", "dificultad");
    inputDif2.setAttribute("value", "dificil");
    var spanDif2 = document.createElement("span");
    spanDif2.textContent = "DIFICIL";
    labelDif2.appendChild(inputDif2);
    labelDif2.appendChild(spanDif2);

    //Añadir elementos de dificultad a su contenedor
    SelectorDificultades.appendChild(labelDif1);
    SelectorDificultades.appendChild(labelDif2);
    
    ContenedorDificultades.appendChild(TituloDificultades);
    ContenedorDificultades.appendChild(SelectorDificultades);

    //Boton jugar
    var botonJugar = document.createElement("button");
    botonJugar.setAttribute("class", "boton_jugar");
    botonJugar.setAttribute("id", "boton_jugar2");
    botonJugar.setAttribute("onclick", "Jugar('"+modoSeleccionado+"')");
    botonJugar.textContent = "Jugar";

    //Añadir contenedores al contenedor principal
    Principal.appendChild(ContenedorLigas);
    Principal.appendChild(ContenedorDificultades);
    Principal.appendChild(botonJugar);

    //Añadir contenido al body
    document.body.appendChild(volverAtras);
    document.body.appendChild(Principal);

}

function Jugar(modo) {
    var ligaSeleccionada = document.querySelector('input[name="liga"]:checked').value;
    var dificultadSeleccionada = document.querySelector('input[name="dificultad"]:checked').value;
    console.log("Parametros de la partida: Modo -> " + modo + "  |  Liga -> " + ligaSeleccionada + "  |  Dificultad -> " + dificultadSeleccionada);
}   

