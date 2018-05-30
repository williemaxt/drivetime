
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}

//code for opening and closing the modal
// Get the modal
var modal = document.getElementById('infoModal');
var filesModal = document.getElementById('filesModal');
// Get the button that opens the modal
var btn = document.getElementById('infoBtn');
var filesBtn = document.getElementById('filesBtn');
// Get the <span> element that closes the info modal
var span = document.getElementsByClassName("close")[0];
// Get the <span> element that closes the files modal
var spanFiles = document.getElementsByClassName("closeFiles")[0];
//displays the info modal
btn.onclick = function() {
    modal.style.display = "block";
}
//displays the files modal
filesBtn.onclick = function() {
    filesModal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
//close when user clicks on spanFiles
spanFiles.onclick = function() {
    filesModal.style.display = "none";
}
