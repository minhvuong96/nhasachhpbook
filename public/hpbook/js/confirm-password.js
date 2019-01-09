var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm-password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Mật khẩu xác nhận chưa đúng.");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
// $(document).ready(function() {
// 	var password = document.getElementById("password");
// 	var confirm_password = document.getElementById("confirm-password");
// 	  if(password.value != confirm_password.value) {
// 	    confirm_password.setCustomValidity("Passwords Don't Match");
// 	  } else {
// 	    confirm_password.setCustomValidity('');
// 	  }
// });