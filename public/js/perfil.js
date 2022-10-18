/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function mostrarmenu() {
    document.getElementById("myDropdown").classList.toggle("show");
    document.getElementById("main-menu").classList.toggle("menu-negro");
  }
  
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
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
    }
  }