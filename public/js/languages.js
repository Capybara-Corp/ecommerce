/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function mostraridiomas() {
var mylanguages = document.getElementById("myLanguages");
    var mainMenu = document.getElementById("main-menu");

    if(mylanguages.classList.contains('show')){
        mylanguages.classList.remove('show');
        activado -= 1;
        //alert(activado);
    }
    else{
        mylanguages.classList.add("show");
        activado += 1;
        //alert(activado);
    }

    if(mainMenu.classList.contains('menu-negro')){
        if(activado == 0){
        mainMenu.classList.remove("menu-negro");
        }
    }
    else{
        mainMenu.classList.add("menu-negro");
        
    }
 
  }