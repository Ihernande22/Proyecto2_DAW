const nombre = document.getElementById("usuario");
const contraseña = document.getElementById("contraseña");

const form = document.getElementById("formulario");

const parragrafo = document.getElementById("warnings")
console.log(nombre);

form.addEventListener("submit", e=>{
   e.preventDefault();
   let warnings = "";
   let regexContraseña = /(?=(.*[0-9]))(?=.*[\!@#$%^&*()\\[\]{}\-_+=|:;"'<>,./?])(?=.*[a-z])(?=(.*[A-Z]))(?=(.*)).{8,}/
   let entrar = false;
   parragrafo.textContent = "";

   if(nombre.value === ""){
      warnings += `El campo nombre esta vacio `
      entrar = true;
   }
   else if(nombre.value.length < 6){
      warnings += `El nombre tiene menos de 6 caracteres  `
      entrar = true;

   }
  
   if(contraseña.value === ""){
      warnings += `El campo constraseña esta vacio  `
      entrar = true;
   }
   
   else if(contraseña.value.length <6){ 
      warnings += `La contraseña no es valida  `
      entrar = true;
   } 
   else if(!regexContraseña.test(contraseña.value)){
      warnings += `La contraseña no cumple los requisitos  `
      entrar = true;


   }
   if(entrar){
      parragrafo.textContent = warnings;
   }else{
   parragrafo.textContent = "Enviado"
   }
})
