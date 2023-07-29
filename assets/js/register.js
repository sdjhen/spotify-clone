$(document).ready(function () {
  // `Hide login form
  $('#hideLogin').click(function () {
    $('#loginForm').hide();
    // Show register form
    $('#registerForm').show();
  });

  $('#hideRegister').click(function () {
    // Hide register form
    $('#loginForm').show();
    // Show login form
    $('#registerForm').hide();
  });
});
