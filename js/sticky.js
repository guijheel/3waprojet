
/*

        Fonction deplace la navbar par rapport  à l'utilisateur
        et qui met automatique le footer en bas de page au déplacement utilisateur

*/

const navbar = document.getElementsByClassName("navbar")
const footer = document.getElementsByClassName("footer")
let sticky = navbar.offsetTop;

function sticky_bar() {
  if (window.pageYOffset > 0) {
    navbar[0].classList.add("sticky");
    footer[0].classList.add("sticky_bot");
  } else {
    navbar[0].classList.remove("sticky");
  }
}
window.onscroll = function() {sticky_bar()};


