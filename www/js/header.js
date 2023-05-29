/* JS pro hlavicku */

window.addEventListener('scroll', scrollHeaderFunction);


var prevNav;
var prevScrollpos = window.pageYOffset;


/**
 * Funkce pro skryti a zobrazeni hlavicky
*/
function scrollHeaderFunction() {
  
    if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
      document.getElementsByClassName('header')[0].style.backgroundColor = "#2b2b2c";
    } else {
      document.getElementsByClassName("header")[0].style.backgroundColor = "transparent";
    }
  
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos >= currentScrollPos) {
      document.getElementsByClassName("header")[0].style.display = "flex";
      if (window.screen.width <= 768) {
        document.getElementsByClassName("header__hamburger-menu")[0].classList.remove("show");
      }
  
    } else {
      document.getElementsByClassName("header")[0].style.display = "none";
      if (window.screen.width <= 768) {
        document.getElementsByClassName("header__hamburger-menu")[0].classList.remove("show");
      }
    }
    prevScrollpos = currentScrollPos;
  }




/**
 * Funkce pro nastaveni pozadi hlavicky pri najeti mysi
*/
window.OverFunction = function(){
    prevNav = document.getElementsByClassName("header")[0].style.backgroundColor;
    document.getElementsByClassName("header")[0].style.backgroundColor = "#2b2b2c";
}
  
/**
 * Funkce pro nastaveni pozadi hlavicky do puvodniho stavu pri prejeti mysi jinam
*/
window.OutFunction = function(){
    document.getElementsByClassName("header")[0].style.backgroundColor = prevNav;
}
  
  
  
/**
 * Funkce pro tlacitko .start
*/
window.openPage = function(){
    document.getElementsByClassName("page")[0].scrollIntoView();
}


/**
 * Funkce pro otevreni hamburger menu
*/
window.dropdown_menu = function(){
    document.getElementsByClassName("header__hamburger-menu")[0]?.classList.toggle("show");
}