// function LoadPagePassword() {
//     $.ajax("password.php")
//         .done(function (rs) {
//             $('#grid-column-number-10-js').html(rs);
//         })
// }




var clickfile = document.querySelector(".account-profile-container-iput-file");
var btnfile = document.querySelector(".account-profile-container-iput-file-btn");
btnfile.onclick = function () {
    clickfile.click();
};
var clickaccount = document.querySelector(".account-navbar-container-flex");
var showaccount = document.querySelector(".account-navbar-container-item");
clickaccount.onclick = function () {
    showaccount.classList.add("block123");

}

// click file
var filechange = document.querySelector(".account-profile-container-iput-file");
var showfile = document.querySelector(".show-file");
filechange.onchange = function () {

    showfile.innerText = filechange.files[0].name;
}
