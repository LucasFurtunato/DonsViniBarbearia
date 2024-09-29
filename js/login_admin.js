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

// Deixa o campo de e-mail sempre em minúsculas
$('#email').on('input', function() {
   $(this).val($(this).val().toLowerCase());
});