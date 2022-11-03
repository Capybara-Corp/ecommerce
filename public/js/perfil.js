/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function mostrarmenu() {
  

    var myDropDown = document.getElementById("myDropdown")
    var mainMenu = document.getElementById("main-menu");

    if(myDropDown.classList.contains('show')){
        myDropDown.classList.remove('show');
        activado -= 1;
        //alert(activado);
    }
    else{
        myDropDown.classList.add("show");
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
  //alert(activado);

  
  
  
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn') && !event.target.matches('#myLanguages') && !event.target.matches('.dropbtnLan')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var languages = document.getElementById("myLanguages");
      var menu = document.getElementById("main-menu");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        } 
      }
      if (languages.classList.contains('show')) {
        languages.classList.remove('show');
      }
      if (menu.classList.contains('menu-negro')) {
        menu.classList.remove('menu-negro');
       
      }
      activado = 0;
      //alert(activado);
  }
  }