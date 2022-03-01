

var btnadd = document.querySelector(".container-details-minus-btn-btn");
var btnminus = document.querySelector(".container-details-minus");
var inputvalue = document.querySelector(".container-details-input-text");
inputvalue.onchange = function (e) {
    if (e.target.value < 300) {
        e.target.value;
    } else {
        e.target.value = 300;
    }
    if (e.target.value > 0) {
        e.target.value;
    } else {
        e.target.value = 1;
    }

}
function btnaddvalue() {

    var inputvalue = document.querySelector(".container-details-input-text");
    var inputvaluevalue = document.querySelector(".container-details-input-text").value;
    var sonumber = Number(inputvaluevalue);
    if (sonumber < 300) {
        sonumbers = sonumber + 1;
        inputvalue.value = sonumbers;
    }
    else {
        var sonumber = 300;
        inputvalue.value = sonumber;
    }

}
function btnminusvalue() {
    var inputvalue = document.querySelector(".container-details-input-text");
    var inputvaluevalue = document.querySelector(".container-details-input-text").value;
    var sonumber = Number(inputvaluevalue);
    if (sonumber < 1) {
        inputvalue.value = 1;
    }
    else if (sonumber > 1) {
        sonumbers = sonumber - 1;
        inputvalue.value = sonumbers;
    }
    else {
        var sonumber = 1;
        inputvalue.value = sonumber;
    }

}
btnadd.addEventListener("click", btnaddvalue);
btnminus.addEventListener("click", btnminusvalue);






let chosenColor = "";
let chosenSize = "";
function displayChosenSizeColor() {
    let $colorButtonItems = $(".container-details-button-color");
    let $sizeButtonItems = $(".container-details-button-size");
    if (chosenColor != "") {
        $colorButtonItems.each((index, element) => {
            if ($(element).text().trim() == chosenColor) {

                $(element).addClass("click click1");
                $(element).find("i").addClass("click");
                $(element).find("div").addClass("click");
            }
        })
    }
    if (chosenSize != "") {
        $sizeButtonItems.each((index, element) => {
            if ($(element).text().trim() == chosenSize) {
                $(element).addClass("click click2");
                $(element).find("i").addClass("clicksize");
                $(element).find("div").addClass("clicksize");
            }
        })
    }
}

function addEventForColor() {
    var detailscheckcolor = document.querySelectorAll(".container-details-button-color");
    var brgcolor = document.querySelectorAll(".container-details-button-color-backg");
    var check = document.querySelectorAll(".container-details-button-focus");
    var inputcolor = document.querySelector(".container-details-input-color");
    for (var i = 0; i < detailscheckcolor.length; i++) {
        detailscheckcolor[i].onclick = function (e) {
            for (var i = 0; i < detailscheckcolor.length; i++) {
                detailscheckcolor[i].classList.remove("click1");
            }
            for (var i = 0; i < brgcolor.length; i++) {
                brgcolor[i].classList.remove("click");
            }
            for (var i = 0; i < check.length; i++) {
                check[i].classList.remove("click");
            }
            var btncolor = e.target;

            console.log(e.target.innerText);
            var checks = e.target.children[0];
            var brg = e.target.children[1];
            btncolor.classList.add("click1");
            checks.classList.add("click");
            brg.classList.add("click");
            console.log(inputcolor.value = e.target.innerText);
            console.log(e);
            var idss = document.querySelector(".id-products").value;
            console.log(idss);
            var cl = e.target.innerText;
            chosenColor = e.target.innerText.trim();


            $.ajax({
                // url :"https://jsonplaceholder.typicode.com/posts",
                url: "./xulycolor.php",
                data: { color: cl, idpr: idss },
                // dataType: 'json',
                success: function (rs) {
                    // console.log(rs);
                    var kqcolor = "";
                    rs = JSON.parse(rs);
                    $.each(rs, function (i, item) {
                        kqcolor += `
                                        <button class="container-details-button-size" onclick="onclicksize()" checked="checked">
                                            ${item.size_name}
                                                <i class="fal fa-check container-details-button-checked"
                                                    onclick="event.stopPropagation()"></i>
                                                <div class="container-details-button-color-checked"
                                                    onclick="event.stopPropagation()"></div>
                                        </button>
                                        `;
                    });
                    $(".container-details-size-item").html("");
                    $(".container-details-size-item").html((index, currentValue) => {
                        return currentValue + kqcolor;

                    });



                    // return detailschecksize;
                    var detailschecksize = document.querySelectorAll(".container-details-button-size");
                    addEventForSize();
                    displayChosenSizeColor();

                }
            });


        }
    }
}
addEventForColor();





function addEventForSize() {
    var detailschecksize = document.querySelectorAll(".container-details-button-size");
    console.log(detailschecksize);


    var brgsize = document.querySelectorAll(".container-details-button-color-checked");
    var checksize = document.querySelectorAll(".container-details-button-checked");
    var inputsize = document.querySelector(".container-details-input-size");

    for (var i = 0; i < detailschecksize.length; i++) {
        detailschecksize[i].onclick = function (e) {
            for (var i = 0; i < detailschecksize.length; i++) {
                detailschecksize[i].classList.remove("click2");
            }
            for (var i = 0; i < brgsize.length; i++) {
                brgsize[i].classList.remove("clicksize");
            }
            for (var i = 0; i < checksize.length; i++) {
                checksize[i].classList.remove("clicksize");
            }
            var btnsize = e.target;

            console.log(e.target);
            var checksizess = e.target.children[0];
            console.log(e.target.children[0]);
            var brgsizess = e.target.children[1];
            btnsize.classList.add("click2");
            checksizess.classList.add("clicksize");
            brgsizess.classList.add("clicksize");
            inputsize.value = e.target.innerText;
            var idproduct = document.querySelector(".id-products").value;
            var size = e.target.innerText;
            chosenSize = e.target.innerText.trim()

            console.log(size);
            console.log(idproduct);
            $.ajax({
                // url :"https://jsonplaceholder.typicode.com/posts",
                url: "./xulysize.php",
                data: { sizes: size, idproducts: idproduct },
                // dataType: 'json',
                success: function (rs) {
                    // console.log(rs);
                    var kqsize = "";
                    rs = JSON.parse(rs);
                    $.each(rs, function (i, item) {
                        kqsize += `
                                            <button class="container-details-button-color" onclick="onclickcolor()" checked="checked">
                                                ${item.color_name}
                                                <i class="fal fa-check container-details-button-focus" onclick="event.stopPropagation()"></i>
                                                <div class="container-details-button-color-backg" onclick="event.stopPropagation()"></div>
                                            </button>
                                            `;
                    });
                    $(".container-details-color-item").html("");
                    $(".container-details-color-item").html((index, currentValue) => {
                        return currentValue + kqsize;
                    });
                    addEventForColor()
                    displayChosenSizeColor()
                }
            });

        }
    }
}
addEventForSize()
// button color
// var detailscheckcolor = document.querySelectorAll(".container-details-button-color");
// var brgcolor = document.querySelectorAll(".container-details-button-color-backg");
// var check = document.querySelectorAll(".container-details-button-focus");
// var inputcolor = document.querySelector(".container-details-input-color");
// for (var i = 0; i < detailscheckcolor.length; i++) {
//     detailscheckcolor[i].onclick = function (e) {
//         for (var i = 0; i < detailscheckcolor.length; i++) {
//             detailscheckcolor[i].classList.remove("click1");
//         }
//         for (var i = 0; i < brgcolor.length; i++) {
//             brgcolor[i].classList.remove("click");
//         }
//         for (var i = 0; i < check.length; i++) {
//             check[i].classList.remove("click");
//         }
//         var btncolor = e.target;

//         console.log(e.target.innerText);
//         var checks = e.target.children[0];
//         var brg = e.target.children[1];
//         btncolor.classList.add("click1");
//         checks.classList.add("click");
//         brg.classList.add("click");
//         console.log(inputcolor.value = e.target.innerText);
//     }

// }



// //btn size
// var detailschecksize = document.querySelectorAll(".container-details-button-size");
// var brgsize = document.querySelectorAll(".container-details-button-color-checked");
// var checksize = document.querySelectorAll(".container-details-button-checked");
// var inputsize = document.querySelector(".container-details-input-size");
// for (var i = 0; i < detailschecksize.length; i++) {
//     detailschecksize[i].onclick = function (e) {
//         for (var i = 0; i < detailschecksize.length; i++) {
//             detailschecksize[i].classList.remove("click2");
//         }
//         for (var i = 0; i < brgsize.length; i++) {
//             brgsize[i].classList.remove("clicksize");
//         }
//         for (var i = 0; i < checksize.length; i++) {
//             checksize[i].classList.remove("clicksize");
//         }
//         var btnsize = e.target;

//         console.log(e.target);
//         var checksizess = e.target.children[0];
//         console.log(e.target.children[0]);
//         var brgsizess = e.target.children[1];
//         btnsize.classList.add("click2");
//         checksizess.classList.add("clicksize");
//         brgsizess.classList.add("clicksize");
//         inputsize.value = e.target.innerText;

//     }

// }

// hiện ra modal image 
var clickimage = document.querySelectorAll(".container-lider-image");
var clickimagebig = document.getElementById("container-details-image-img-id");
var clickmodalimg = document.querySelector(".modal-details-img");
var clickmodalimgcontainer = document.querySelector(".details-image");
var imagebig = document.querySelector(".details-image-big-img");
var clickimagesmall = document.querySelectorAll(".details-image-small-item-border");
for (var i = 0; i < clickimage.length; i++) {
    clickimage[i].onclick = function (e) {

        var clickaddimgsmall = e.target.src;

        imagebig.src = clickaddimgsmall;
        for (var i = 0; i < clickimagesmall.length; i++) {

            clickimagesmall[i].children[1].classList.remove("block");
            if (clickimagesmall[i].children[0].src == clickaddimgsmall) {
                clickimagesmall[i].children[1].classList.add("block");
            }
        }
        clickmodalimg.classList.add("open");

    }

}
clickimagebig.onclick = function () {
    var showimgbig = clickimagebig.src;
    imagebig.src = showimgbig;
    console.log(clickimagebig.src);
    for (var i = 0; i < clickimagesmall.length; i++) {

        clickimagesmall[i].children[1].classList.remove("block");
    }

    for (var i = 0; i < imgsmallhover.length; i++) {

        if (clickimagebig.src == imgsmallhover[i].src) {
            console.log(imgsmallhover[i].parentElement.children[1]);
            var bordercheck = imgsmallhover[i].parentElement.children[1];
            bordercheck.classList.add("block");
        }

    }
    clickmodalimg.classList.add("open");
}
for (var i = 0; i < clickimage.length; i++) {
    clickimage[i].onmouseover = function (e) {

        var clickaddimgsmall = e.target.src;

        clickimagebig.src = clickaddimgsmall;

    }

}



function removemodalimg() {
    clickmodalimg.classList.remove("open");
}
clickmodalimgcontainer.addEventListener("click", function (e) {
    e.stopPropagation();
})
clickmodalimg.addEventListener("click", removemodalimg);


var imagebig = document.querySelector(".details-image-big-img");
var imgsmallhover = document.querySelectorAll(".details-image-small-img");
var clickimagesmall = document.querySelectorAll(".details-image-small-item-border");
var clickiimgborder = document.querySelectorAll(".details-image-small-item-border-color");
var clickiimghover = document.querySelectorAll(".details-image-small-item-hover");
for (var i = 0; i < clickiimghover.length; i++) {
    clickiimghover[i].onmouseover = function (e) {

        for (var i = 0; i < clickiimghover.length; i++) {
            clickiimghover[i].classList.remove("showhover");
        }
        console.log(e.target.classList.add("showhover"));


    }
    clickiimghover[i].onmouseout = function (e) {
        e.target.classList.remove("showhover")
    }
}

for (var i = 0; i < clickiimghover.length; i++) {
    clickiimghover[i].onclick = function (e) {
        e.stopPropagation();
        var imgsmall = e.path[1].children[0];

        imagebig.src = imgsmall.src;

        for (var i = 0; i < clickiimgborder.length; i++) {
            clickiimgborder[i].classList.remove("block");
        }
        e.path[1].children[1].classList.add("block");

    }

}
//onclick show modal notification and kierm tra text co value chuwa
var btnaddcart = document.querySelector(".container-details-add");
var showmodalnotifi = document.querySelector(".app-chitiet-notifi");
btnaddcart.onclick = function () {
    var inputcoloradd = document.querySelector(".container-details-input-color");
    var inputsizeadd = document.querySelector(".container-details-input-size");
    if (inputcoloradd.value.length != 0 && inputsizeadd.value.length != 0) {
        showmodalnotifi.classList.add("block123");
        setTimeout(function () {
            showmodalnotifi.classList.remove("block123");
        }, 3000)

    }
}

var btnbuy = document.querySelector(".container-details-button-buy");
btnbuy.onclick = function () {

    setTimeout(function () {
        var inputcoloradds = document.querySelector(".container-details-input-color");
        var inputsizeadds = document.querySelector(".container-details-input-size");

        inputcoloradds.value == '';
        inputsizeadds.value == '';
    }, 3000)
}

