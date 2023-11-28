document.addEventListener("DOMContentLoaded", function () {
    // Plaats hier de rest van je JavaScript-code
    var myButton = document.getElementById("myButton");
    var myPopup = document.getElementById("myPopup");
    var closePopup = document.getElementById("closePopup");

    myButton.addEventListener("click", function () {
        myPopup.classList.add("show");
    });

    closePopup.addEventListener("click", function () {
        myPopup.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target == myPopup) {
            myPopup.classList.remove("show");
        }
    });
});



//hier worden de pop up laten zien als je op de knop klikt
myButton.addEventListener("click", function () {
    myPopup.classList.add("show");
});
closePopup.addEventListener("click", function () {
    myPopup.classList.remove("show");
});
window.addEventListener("click", function (event) {
    if (event.target == myPopup) {
        myPopup.classList.remove("show");
    }
});