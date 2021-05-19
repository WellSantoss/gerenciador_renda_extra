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

