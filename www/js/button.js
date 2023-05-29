/* JS pro plovouci tlacitko */

window.addEventListener('scroll', scrollButttFunction);


/**
 * Funkce pro skryti a zobrazeni plovouciho tlacitka
*/
function scrollButttFunction() {
  let mybutton = document.getElementById("myBtn");

  if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

/**
 * Funkce pro vyscrolovani stranky nahoru
*/
window.topFunction = function() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

