function initMenu() {
  const btnMenu = document.querySelector('.menu > a');
  const menu = document.querySelector('.menu ul');

  btnMenu.addEventListener('click', (event) => {
    event.preventDefault();
    menu.classList.toggle('active');
  });
}
initMenu();

function initModal() {
  const modal = document.querySelector('.modal');
  const btnModal = document.querySelector('#btn-modal');
  const btnCancelar = document.querySelector('#btn-cancelar');

  btnModal.addEventListener('click', (event) => {
    event.preventDefault();
    modal.classList.add('active');
  });

  btnCancelar.addEventListener('click', (event) => {
    event.preventDefault();
    modal.classList.remove('active');
  })
}
initModal();

