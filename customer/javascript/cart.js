// check chon tat ca
var input = document.querySelector(".container-cart-category-input-check");
var inputfooter = document.querySelector(".container-cart-details-buy-input-check");
var input = document.querySelector(".container-cart-category-input-check");
var inputsmall = document.querySelectorAll(".container-cart-details-products-input-check");
function clickinput() {
    for (var i = 0; i < inputsmall.length; i++) {
        if (input.checked) {
            inputsmall[i].checked = true;
            inputfooter.checked = true;
        }
        else {
            inputsmall[i].checked = false;
            inputfooter.checked = false;
        }
    }
}
function clickinputfooter() {
    for (var i = 0; i < inputsmall.length; i++) {
        if (inputfooter.checked) {
            inputsmall[i].checked = true;
            input.checked = true;
        }
        else {
            inputsmall[i].checked = false;
            input.checked = false;
        }
    }
}
// o input click cong tru so
input.addEventListener("click", clickinput);
inputfooter.addEventListener("click", clickinputfooter);


var btnadd = document.querySelectorAll(".container-details-minus-btn-btn");
var btnminus = document.querySelectorAll(".container-details-minus");
var inputvalue = document.querySelectorAll(".container-details-input-text");
for (var i = 0; i < inputvalue.length; i++) {
    inputvalue[i].onchange = function (e) {
        if (e.target.value < 300) {
            e.target.value;
            console.log(e);
            //gan input submit
            e.path[2].children[0].children[3].value = e.target.value;
        } else {
            e.target.value = 300;
            e.path[2].children[0].children[3].value = 300;
        }
        if (e.target.value > 0) {
            e.target.value;
            //gan input submit
            e.path[2].children[0].children[3].value = e.target.value;
        } else {
            e.target.value = 1;
            // gan input submit;
            e.path[2].children[0].children[3].value = 1;
        }

    }
}
for (var i = 0; i < btnadd.length; i++) {

    btnadd[i].onclick = function (e) {
        console.log(e);

        var inputsubmit = e.path[2].children[1];
        var inputvalue = e.path[2].children[1].value;
        // console.log(inputsubmit);
        // console.log(inputvalue);


        var sonumber = Number(inputvalue);
        console.log(typeof sonumber);
        if (sonumber < 300) {

            sonumbers = sonumber + 1;
            inputsubmit.value = sonumbers;
            // console.log(e.path[2].children[3].value);
            // gan gia tri cho o input submit
            e.path[2].children[3].value = sonumbers;
        }
        else {
            var sonumbers = 300;
            inputsubmit.value = sonumbers;
            e.path[2].children[3].value = sonumbers;
        }
    }

}
for (var i = 0; i < btnminus.length; i++) {

    btnminus[i].onclick = function (e) {
        console.log(e);

        var inputsubmit = e.path[2].children[1];
        var inputvalue = e.path[2].children[1].value;
        console.log(inputsubmit);
        console.log(inputvalue);


        var sonumber = Number(inputvalue);
        console.log(typeof sonumber);
        if (sonumber > 1) {

            sonumbers = sonumber - 1;
            console.log(sonumbers);
            inputsubmit.value = sonumbers;
            // console.log(e.path[2].children[3].value);
            // gan gia tri cho o input submit
            e.path[2].children[3].value = sonumbers;
        }
        else {
            var sonumbers = 1;
            inputsubmit.value = sonumbers;
            //gan input submit
            e.path[2].children[3].value = sonumbers;
        }
    }

}




//btn color
var detailscheckcolor = document.querySelectorAll(".classity-details-btn-item1");
var brgcolor = document.querySelectorAll(".classity-details-btn-color");
var check = document.querySelectorAll(".classity-details-btn-check");
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
        // console.log(e.path[1].children[0].value);
        // tim ve cha chung roi toi the input submit
        //gan  gia tri cho cai iput submit ben form submit
        e.path[1].children[0].value = e.target.innerText;
        console.log(btncolor);

        var checks = e.target.children[0];
        var brg = e.target.children[1];
        btncolor.classList.add("click1");
        checks.classList.add("click");
        brg.classList.add("click");


    }

}



//btn size
var detailschecksize = document.querySelectorAll(".classity-details-btn-item2");
var brgsize = document.querySelectorAll(".classity-details-btn-size");
var checksize = document.querySelectorAll(".classity-details-btn-check-size");
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
        // console.log(e.path[1].children[0].value);
        // tim ve cha chung roi toi the input submit
        //gan  gia tri cho cai iput submit ben form submit
        e.path[1].children[0].value = e.target.innerText;


        var checksizess = e.target.children[0];

        var brgsizess = e.target.children[1];
        btnsize.classList.add("click2");
        checksizess.classList.add("clicksize");
        brgsizess.classList.add("clicksize");


    }

}

// hien ra classity
var classity = document.querySelectorAll(".container-cart-details-products-classity-big");
var classityheading = document.querySelectorAll(".container-cart-details-products-classity-heading");
var classitytext = document.querySelectorAll(".container-cart-details-products-classity-text");
var btnback = document.querySelectorAll(".classity-details-submit-back");
var shows = document.querySelectorAll(".container-cart-details-products-classity-heading");
var noibot = document.querySelectorAll(".container-cart-details-products-classity-button-btn");
var daucham = document.querySelectorAll(".container-cart-details-products-daucham");
for (var i = 0; i < classitytext.length; i++) {
    classitytext[i].onclick = function (e) {
        var showmodal = e.path[2].children[2];
        //show cai modal ra
        showmodal.classList.add("block");
    }
}
for (var i = 0; i < shows.length; i++) {
    shows[i].onclick = function (e) {
        var showmodals = e.path[2].children[2];
        //show cai modal ra
        showmodals.classList.add("block");
    }
}
for (var i = 0; i < btnback.length; i++) {
    btnback[i].onclick = function (e) {
        var backmodal = e.path[4];
        //btn tro lai
        backmodal.classList.remove("block");
    }
}
for (var i = 0; i < noibot.length; i++) {
    noibot[i].onclick = function (e) {
        e.stopPropagation();
    }
}
for (var i = 0; i < daucham.length; i++) {
    daucham[i].onclick = function (e) {
        e.stopPropagation();
    }
}


//btn xac nhan
var btnxn = document.querySelectorAll(".classity-details-submit-next");
for (var i = 0; i < btnxn.length; i++) {
    btnxn[i].onclick = function (e) {
        console.log(e);
        var btncolor = e.path[2].children[0].children[1].children[0];
        var btnsize = e.path[2].children[1].children[1].children[0];
        var activecolor = document.querySelector(".click1");
        var activesize = document.querySelector(".click2");
        if (activecolor && activesize) {
            var colornow = e.path[5].children[1].children[0];
            var sizenow = e.path[5].children[1].children[2];
            colornow.innerText = activecolor.innerText;
            sizenow.innerText = activesize.innerText;
            e.path[4].classList.remove("block");
        }
        else {
            alert("sasdsaasd");

        }


    }

}



const addbtnpay = document.querySelector(".container-pay-address-button-add-btn");
const backbtnpay = document.querySelector(".app-pay-btn-back");
const modal = document.querySelector(".modal-app");
function showmodalpay() {
    modal.classList.add("open");
}
function removemodalpay() {
    modal.classList.remove("open");
}
addbtnpay.addEventListener("click", showmodalpay);
backbtnpay.addEventListener("click", removemodalpay);




