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


    // Função para alternar visibilidade da senha no campo 1
    $('#btn-password-1').click(function() {
      let inputPass = $('#password-1');
      let btnPass = $('#btn-password-1');

      if (inputPass.attr('type') === 'password') {
          inputPass.attr('type', 'text');
          btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
          inputPass.attr('type', 'password');
          btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
      }
  });

  // Função para alternar visibilidade da senha no campo 2
  $('#btn-password-2').click(function() {
      let inputPass = $('#password-2');
      let btnPass = $('#btn-password-2');

      if (inputPass.attr('type') === 'password') {
          inputPass.attr('type', 'text');
          btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
      } else {
          inputPass.attr('type', 'password');
          btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
      }
  });

  // Função para alternar visibilidade da senha no campo 3
  $('#btn-password-3').click(function() {
   let inputPass = $('#password-3');
   let btnPass = $('#btn-password-3');

   if (inputPass.attr('type') === 'password') {
       inputPass.attr('type', 'text');
       btnPass.removeClass('bi-eye').addClass('bi-eye-slash');
   } else {
       inputPass.attr('type', 'password');
       btnPass.removeClass('bi-eye-slash').addClass('bi-eye');
   }
});


  // Deixa o campo de e-mail sempre em minúsculas
  $('#email').on('input', function() {
      $(this).val($(this).val().toLowerCase());
  });



  $(document).ready(function() {
      $("#cUsrPassInvalid").hide();
      $("#cUsrPassValid").hide();
      $("#cErroInvalid").hide();
      $("#lUsrPassInvalid").hide();

      // Ao clicar no botão de editar perfil
      $('#btnCadastro').on('click', function(event) {
          event.preventDefault(); // Prevenir o comportamento padrão do botão
          
          // Verificar se todos os campos estão preenchidos
          let nome = $('#nome').val().trim();
          let email = $('#email').val().trim();
          let senha = $('#password-1').val().trim();
          let confirmarSenha = $('#password-2').val().trim();
  
          // Função de validação de email
          function validarEmail(email) {
              return email.includes('@') && email.includes('.');
          }
  
          // Se algum campo estiver vazio, exibir mensagem de erro
          if (nome === '' || email === '' || senha === '' || confirmarSenha === '') {
              alert("Por favor, preencha todos os campos.");
          } else if (!validarEmail(email)) {
              // Verificar se o email contém "@" e "."
              alert("Por favor, insira um e-mail válido.");
          } else if (senha !== confirmarSenha) {
              // Verificar se as senhas não correspondem
              alert("As senhas do funcionário não correspondem. Por favor, tente novamente.");
          } else {
            $.post("php/controlador/processar-cadastro.php", $("#frmCadastro").serialize(), function( dados ){

               var objRetorno = JSON.parse(dados);
               
               if (objRetorno.cadastro == "false" && objRetorno.erro == "1"){
                     $("#cUsrPassInvalid").show();
                     $("#cUsrPassValid").hide();
                     $("#cErroInvalid").hide();
               }else if (objRetorno.cadastro == "false" && objRetorno.erro == "2"){
                     $("#cUsrPassInvalid").hide();
                     $("#cUsrPassValid").hide();
                     $("#cErroInvalid").show();
               }
               else{
                     $("#cUsrPassInvalid").hide();
                     $("#cUsrPassValid").show();
                     $("#cErroInvalid").hide();
               }
            });
          }
      });

      $('#btnLogin').on('click', function(event) {
         event.preventDefault(); // Prevenir o comportamento padrão do botão
         
         // Verificar se todos os campos estão preenchidos
         let email = $('#email2').val().trim();
         let senha = $('#password-3').val().trim();
 
         // Função de validação de email
         function validarEmail(email) {
             return email.includes('@') && email.includes('.');
         }
 
         // Se algum campo estiver vazio, exibir mensagem de erro
         if (email === '' || senha === '') {
             alert("Por favor, preencha todos os campos.");
         } else if (!validarEmail(email)) {
             // Verificar se o email contém "@" e "."
             alert("Por favor, insira um e-mail válido.");
         } else {
            $("#btnLogin").click(function(){
                $.post("php/controlador/processar-login.php", $("#frmLogin").serialize(), function( dados ){
                    var objRetorno = JSON.parse(dados);
                    if ( objRetorno.login == "false"){
                        $("#lUsrPassInvalid").show();
                    }else{
                        window.location.href = 'index.php';
                    }
                });
            });
         }
     });
  });
  
