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
 