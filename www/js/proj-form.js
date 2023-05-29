


/* JS pro formular pro vytvoreni noveho projektu */

/**
 * Funkce pro otevreni formulare pro vytvoreni noveho projektu
*/
window.openForm = function() {
    document.getElementsByClassName("modal")[0].style.display = "block";
  }
    
/**
 * Funkce pro zavreni formulare pro vytvoreni noveho projektu
*/
window.closeForm = function() {
  document.getElementsByClassName("modal")[0].style.display = "none";
}
  
/**
 * Funkce pro zavreni formulare pri kliknuti mimo nej
*/
window.onclick = function (event) {
  if (event.target.className === "modal") {
    event.target.style.display = "none";    
  }
};
  