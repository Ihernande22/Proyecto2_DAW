function selectorModo() {
    let modoSeleccionado = document.querySelector('input[name="modoSel"]:checked').value;
    let imagen;
    let descripcion;
    let titulo;
    switch (modoSeleccionado) {
        case "goles":
            localStorage.setItem("modo", "goles");
            titulo = "GOLES";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha anotado más goles a lo largo de su carrera.";
            imagen = "img/modo_goles";
            break;

        case "asistencias":
            localStorage.setItem("modo", "asistencias");
            titulo = "ASISTENCIAS";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha dado más asistencias a lo largo de su carrera.";
            imagen = "img/modo_asistencias";
            break;

        case "valor":
            localStorage.setItem("modo", "valor");
            titulo = "VALOR";
            descripcion = "Infiere entre dos jugadores para intentar adivinar cuál de los dos ha tenido un mayor valor de mercado.";
            imagen = "img/modo_valor";
            break;
        
        case "partidos":
            localStorage.setItem("modo", "partidos");
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

function crearInterfazConfigPartida() {
    //Recargar la pagina para que se vuelva a ejecutar el evento oncharge
    if (!localStorage.getItem("recargar")) {
        localStorage.setItem("recargar", "true");
        location.reload();
    }
    localStorage.setItem("estado","config");
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
        localStorage.setItem("estado", "inicio");
        localStorage.removeItem("liga");
        localStorage.removeItem("dificultad");
        localStorage.removeItem("recargar");
        var containerEliminar = document.getElementById("principal");
        if (containerEliminar) {
            document.body.removeChild(containerEliminar);
            document.body.removeChild(volverAtras);
            document.body.appendChild(containerModos);
        }
        cargarPaginaInicio();
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
    inputLiga1.setAttribute("id", "laliga");
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
    inputLiga2.setAttribute("id", "premier");
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
    inputLiga3.setAttribute("id", "bundesliga");
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
    inputLiga4.setAttribute("id", "serieA");
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
    inputLiga5.setAttribute("id", "aleatorio");
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

    //Cambiar liga en el localstorage
    SelectorLigas.addEventListener("change", function() {
        let liga = document.querySelector('input[name="liga"]:checked').value;
        localStorage.setItem("liga", liga);
    })

    ContenedorLigas.appendChild(TituloLigas);
    ContenedorLigas.appendChild(SelectorLigas);

    //Dificultades
    //Normal
    var labelDif1 = document.createElement("label");
    var inputDif1 = document.createElement("input");
    inputDif1.setAttribute("type", "radio");
    inputDif1.setAttribute("name", "dificultad");
    inputDif1.setAttribute("id", "normal");
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
    inputDif2.setAttribute("id", "dificil");
    inputDif2.setAttribute("value", "dificil");
    var spanDif2 = document.createElement("span");
    spanDif2.textContent = "DIFICIL";
    labelDif2.appendChild(inputDif2);
    labelDif2.appendChild(spanDif2);

    //Cambiar dificultad en el localstorage
    SelectorDificultades.addEventListener("change", function() {
        let dificultad = document.querySelector('input[name="dificultad"]:checked').value;
        localStorage.setItem("dificultad", dificultad);
    })

    //Añadir elementos de dificultad a su contenedor
    SelectorDificultades.appendChild(labelDif1);
    SelectorDificultades.appendChild(labelDif2);
    
    ContenedorDificultades.appendChild(TituloDificultades);
    ContenedorDificultades.appendChild(SelectorDificultades);

    //Boton jugar
    var botonJugar = document.createElement("button");
    botonJugar.setAttribute("class", "boton_jugar");
    botonJugar.setAttribute("id", "boton_jugar2");
    botonJugar.textContent = "Jugar";

    //Añadir contenedores al contenedor principal
    Principal.appendChild(ContenedorLigas);
    Principal.appendChild(ContenedorDificultades);
    Principal.appendChild(botonJugar);

    //Añadir contenido al body
    document.body.appendChild(volverAtras);
    document.body.appendChild(Principal);
}

/*Cargar estado pagina inicio*/
function cargarPaginaInicio() {
    /* Recoge el estado en el que se encuentra el usuario y el modo seleccionado*/
    let estado = localStorage.getItem("estado");
    let modo = localStorage.getItem("modo"); 
    /* En caso de que el usuario se encuentre en el inicio recoge el ultimo valor checked y lo selecciona*/
    if (estado) {
        if (estado == "inicio") {
            let modoPorDefecto = document.getElementById("goles");
            try {
                let modoActual = document.getElementById(modo);
                modoPorDefecto.checked = false;
                modoActual.checked = true;
                selectorModo();
            } catch (error) {
                modoPorDefecto.checked = true;
                selectorModo();      
                localStorage.setItem("modo", "goles");
            }
        }
        else {
            /* En caso de no estar en el inicio recoge la liga y dificultad */
            let liga = localStorage.getItem("liga");
            let dificultad = localStorage.getItem("dificultad");
            crearInterfazConfigPartida();
            if (liga) {
                let ligaSeleccionada = document.getElementById(liga);
                ligaSeleccionada.checked = true;
            }
            if (dificultad) {
                let dificultadSeleccionada = document.getElementById(dificultad);
                dificultadSeleccionada.checked = true;
            }
        }
    }
    else {
        localStorage.setItem("estado", "inicio");
        localStorage.setItem("modo", "goles");
        let modoPorDefecto = document.getElementById("goles");
        modoPorDefecto.checked = true;
        selectorModo();
    }
}

cargarPaginaInicio();

/*function enviarConfiguraciones(confModo, confLiga, confDificultad) {
    //Redirecciona a game.php pasando los parametros de la partida
    window.location.href = "game.php?modo=" + confModo + "&liga=" + confLiga + "&dificultad=" + confDificultad;


    // Borra las configuraciones almacenadas en localStorage
    localStorage.removeItem("modo");
    localStorage.removeItem("liga");
    localStorage.removeItem("dificultad");
    localStorage.removeItem("estado");
    localStorage.removeItem("recargar");
};*/

function enviarConfiguraciones(confModo, confLiga, confDificultad) {
    // Crear un formulario dinámicamente
    var form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "game.php");

    // Crear input para cada configuración y agregarlos al formulario
    var modoInput = document.createElement("input");
    modoInput.setAttribute("type", "hidden");
    modoInput.setAttribute("name", "modo");
    modoInput.setAttribute("value", confModo);
    form.appendChild(modoInput);

    var ligaInput = document.createElement("input");
    ligaInput.setAttribute("type", "hidden");
    ligaInput.setAttribute("name", "liga");
    ligaInput.setAttribute("value", confLiga);
    form.appendChild(ligaInput);

    var dificultadInput = document.createElement("input");
    dificultadInput.setAttribute("type", "hidden");
    dificultadInput.setAttribute("name", "dificultad");
    dificultadInput.setAttribute("value", confDificultad);
    form.appendChild(dificultadInput);

    // Agregar el formulario al body y enviarlo
    document.body.appendChild(form);
    form.submit();

    // Eliminar el formulario después de enviarlo
    document.body.removeChild(form);

    // Borra las configuraciones almacenadas en localStorage
    localStorage.removeItem("modo");
    localStorage.removeItem("liga");
    localStorage.removeItem("dificultad");
    localStorage.removeItem("estado");
    localStorage.removeItem("recargar");

    localStorage.setItem("enPartida", "yes");
    localStorage.setItem("configEnviada", "yes");
}



document.addEventListener("DOMContentLoaded", function() {
    let botonJugar = document.getElementById("boton_jugar2");

    if (botonJugar) {
        botonJugar.addEventListener("click", function() {
            let modoSeleccionado = localStorage.getItem("modo");
            let ligaSeleccionada = localStorage.getItem("liga");
            let dificultadSeleccionada = localStorage.getItem("dificultad");

            console.log("Modo seleccionado:", modoSeleccionado);
            console.log("Liga seleccionada:", ligaSeleccionada);
            console.log("Dificultad seleccionada:", dificultadSeleccionada);

            if (modoSeleccionado && ligaSeleccionada && dificultadSeleccionada) {
                // Enviar configuraciones a game.php
                enviarConfiguraciones(modoSeleccionado, ligaSeleccionada, dificultadSeleccionada);
            } else {
                // Mostrar un mensaje de alerta indicando los parámetros faltantes
                let mensaje = "Falta(n) el/los parámetro(s): ";
                if (!modoSeleccionado) mensaje += "modo ";
                if (!ligaSeleccionada) mensaje += "liga ";
                if (!dificultadSeleccionada) mensaje += "dificultad ";
                
                alert(mensaje);
            }
        });
    }
});



// Hacer peticion ajax a PHP para recibir estadistica