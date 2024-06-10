let current_password = document.getElementById("current_password"),
password = document.getElementById("password"),
confirm_password = document.getElementById("confirm_password");

function validatePassword() {
if (current_password.value == "") {
    current_password.setCustomValidity("كلمه المرور الحاليه مطلوبه");
}

if (confirm_password.value && password.value != confirm_password.value) {
    confirm_password.setCustomValidity("كلمه المرور غير متطابقه");
} else if (!confirm_password.value) {
    confirm_password.setCustomValidity('يجب اعاده تدوين كلمه المرور');
} else {
    confirm_password.setCustomValidity('');
}
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;