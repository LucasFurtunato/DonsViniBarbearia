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


 /* FUNÇÃO PARA DEIXAR ESCONDIDO OS CONTAINERS */

$(document).ready(function() {
   // Ao clicar no botão de editar perfil
   $('#edit-profile-button').on('click', function(event) {
       event.preventDefault(); // Prevenir o comportamento padrão do botão

       // Esconder o primeiro container
       $('#first-container').hide();

       // Mostrar o segundo container
       $('#second-container').show();
   });

   // Ao clicar no botão de cancelar
   $('.cancel-btn').on('click', function(event) {
       event.preventDefault(); // Prevenir o comportamento padrão do botão

       // Esconder o segundo container
       $('#second-container').hide();

       // Mostrar o primeiro container
       $('#first-container').show();
   });

   // Ao clicar no botão de alterar
   $('.btn-second').on('click', function(event) {
       // Não faça nada quando clicar no botão de alterar
       event.preventDefault(); // Prevenir o comportamento padrão do botão
   });
});

