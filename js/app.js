/* JS PARA AO CLICAR NOS BOTÕES, MODIFICAR A ESTRUTURA DO FORMULÁRIO COM O Z-INDEX * E INFORMAR ISSO AO BODY */

var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");


/* FUNÇÃO QUE RECEBE AO CLICAR A CLASSE PARA MODIFICAR A TELA PARA O CADASTRO OU LOGIN - TRANSIÇÃO */

btnSignin.addEventListener("click", function () {
   body.className = "sign-in-js"; 
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})


/* FUNÇÃO MOSTRAR SENHA */

function mostrarSenha1(){
   var inputPass = document.getElementById('password-1')
   var btnPass = document.getElementById('btn-password-1')

   if (inputPass.type === 'password'){
      inputPass.setAttribute ('type', 'text')

      btnPass.classList.replace('bi-eye', 'bi-eye-slash')
   }

   else {
      inputPass.setAttribute ('type', 'password')

      btnPass.classList.replace('bi-eye-slash', 'bi-eye')
   }
}


function mostrarSenha2(){
   var inputPass = document.getElementById('password-2')
   var btnPass = document.getElementById('btn-password-2')

   if (inputPass.type === 'password'){
      inputPass.setAttribute ('type', 'text')

      btnPass.classList.replace('bi-eye', 'bi-eye-slash')
   }

   else {
      inputPass.setAttribute ('type', 'password')

      btnPass.classList.replace('bi-eye-slash', 'bi-eye')
   }
}


function mostrarSenha3(){
   var inputPass = document.getElementById('password-3')
   var btnPass = document.getElementById('btn-password-3')

   if (inputPass.type === 'password'){
      inputPass.setAttribute ('type', 'text')

      btnPass.classList.replace('bi-eye', 'bi-eye-slash')
   }

   else {
      inputPass.setAttribute ('type', 'password')

      btnPass.classList.replace('bi-eye-slash', 'bi-eye')
   }
}


/*DEIXAR TEXTO SEMPRE EM MINÚSCULO */

const emailField = document.getElementById('email');

emailField.addEventListener('input', function() {
    this.value = this.value.toLowerCase();
});

