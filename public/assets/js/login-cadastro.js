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
      // Ao clicar no botão de editar perfil
      $('#btnCadastro').on('click', function(event) {
          event.preventDefault(); // Prevenir o comportamento padrão do botão
          
          // Verificar se todos os campos estão preenchidos
          let nome = $('#nome').val().trim();
          let email = $('#email').val().trim();
          let senha = $('#password-1').val().trim();
          let confirmarSenha = $('#password-2').val().trim();
		  let checkbox = $("#checkbox-example").prop("checked");
  
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
          } else if (!checkbox) {
		      alert("Você deve aceitar os Termos e Condições.");
		  } else {
			$('#responseArea').text("Aguarde alguns segundos");
            $.ajax({
                url: "../controllers/CtrlCliente.php",
                method: "POST",
                data: $("#frmCadastro").serialize(),
                success: function(response) {
                    var objRetorno = JSON.parse(response);

                    if(objRetorno.status == false) {
                        alert(objRetorno.message)
                    } else {
                        $('#responseArea').text(objRetorno.message);
                    }
                },
                error: function(xhr, status, error) {
                    $('#responseArea').text("Erro na requisição: " + error);
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
            $.ajax({
                url: "../controllers/CtrlClienteLogin.php",
                method: "POST",
                data: $("#frmLogin").serialize(),
                success: function(response) {
                    var objRetorno = JSON.parse(response);

                    if ( objRetorno.status == false){
                        alert(objRetorno.message);
                    } else {
                        $("#responseAreaLogin").text("Aguarde");
                        window.location.href = '../../index.html';
                    }
                },
                error: function(xhr, status, error) {
                    $('#responseArea').text("Erro na requisição: " + error);
                }
            });
         }
     });
  });
  
