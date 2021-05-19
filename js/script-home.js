const btnMenu = document.querySelector('.menu > a');
const menu = document.querySelector('.menu ul');

btnMenu.addEventListener('click', (event) => {
  event.preventDefault();
  menu.classList.toggle('active');
});