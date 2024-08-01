// Back-to-Top Button Script

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.querySelector('.btt').style.display = "block";
    } else {
        document.querySelector('.btt').style.display = "none";
    }
}

document.querySelector('.btt').addEventListener('click', () => {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE, and Opera
});
