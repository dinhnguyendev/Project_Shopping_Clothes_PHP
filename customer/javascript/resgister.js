var input = document.querySelectorAll(".form-register-input");
var inputjs = document.querySelectorAll(".form-register-input-js");
var notifi = document.querySelectorAll(".register-notityfication");
for (i = 0; i < input.length; i++) {
    input[i].onclick = function (e) {
        e.path[2].children[1].classList.add("none");

    }
}
for (i = 0; i < inputjs.length; i++) {
    inputjs[i].onclick = function (e) {
        e.path[2].children[2].classList.add("none");

    }
}
