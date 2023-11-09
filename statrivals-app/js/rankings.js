var show = true; 
  
function showCheckBoxes(campo) { 
    switch (campo) {
        case "modo":
            var checkboxes =  document.getElementById("CheckBoxesModo"); 
            break;
        case "liga":
            var checkboxes =  document.getElementById("CheckBoxesLiga"); 
            break;
        case "dificultad":
            var checkboxes =  document.getElementById("CheckBoxesDificultad"); 
            break;
        case "usuarios":
            var checkboxes =  document.getElementById("CheckBoxesUsuarios"); 
            break;
        }
    if (show) { 
        checkboxes.style.display = "flex"; 
        checkboxes.style.flexDirection = "Column";         
        show = false; 
    } else { 
        checkboxes.style.display = "none"; 
        show = true; 
    } 
} 

function showRadioButtons(campo) {
    var radioButtons;
    switch (campo) {
        case "usuarios":
            radioButtons = document.getElementById("RadioButtonsUsuarios");
            break;
        case "modoPuntuacion":
            radioButtons = document.getElementById("RadioButtonsModoPuntuacion");
            break;
    }
    if (show) {
        radioButtons.style.display = "flex";
        radioButtons.style.flexDirection = "Column";
        show = false;
    } else {
        radioButtons.style.display = "none";
        show = true;
    }
}
