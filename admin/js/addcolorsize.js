var input = document.querySelector(".container-input");
input.onchange = function () {
    console.log(input.value);
    var str = input.value;
    var number = Number(str);
    if (number < 1) {
        input.value = 1;
    } else {
        input.value;
    }

}