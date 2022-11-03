/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function mostraridiomas() {
    document.getElementById("myLanguages").classList.toggle("show");
  }
  
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
        if (menu.classList.contains('menu-negro')) {
          menu.classList.remove('menu-negro');
        }
        
      }
      if (languages.classList.contains('show')) {
        languages.classList.remove('show');
      }
    
  }
  }