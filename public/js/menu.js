const toggleMenuElement = document.getElementById('toggle-menu');
const mainMenuElement = document.getElementById('main-menu');
const contenedor = document.getElementById('buscadores');
const contenedor2 = document.getElementById('contenedor_market');

toggleMenuElement.addEventListener('click', () => {
	mainMenuElement.classList.toggle('main-menu--show');
	contenedor.classList.toggle('hide');
	contenedor2.classList.toggle('hide');
});