const modal1 = document.getElementById('RegistrationModal');
const closeModal1 = document.getElementById('closeModal1');
const RegisterButton = document.getElementById('RegisterButton');

window.addEventListener('beforeunload', function() {
    if (modal.style.display === 'block') {
        modal1.style.display = 'none';
    }
});

RegisterButton.addEventListener('click', () => {
    closeAllModals();
    modal1.style.display = 'block';
});

closeModal1.addEventListener('click', () => {
    modal1.style.display = 'none';
});

window.addEventListener('click', (event) => {
    if (event.target === modal1) {
        modal1.style.display = 'none';
    }
});