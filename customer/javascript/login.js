var input = document.querySelectorAll(".form-register-input");
var error = document.querySelectorAll(".notidicatio-error");
for (var i = 0; i < input.length; i++) {
    input[i].onclick = function () {
        for (var i = 0; i < error.length; i++) {

            error[i].classList.add("none");

        }
    }
}