function closeAllModals() {
    modal1.style.display = 'none';
    modal.style.display = 'none';
}
const modal = document.getElementById('loginModal');
const closeModal = document.getElementById('closeModal');
const loginButton = document.getElementById('loginButton');
window.addEventListener('beforeunload', function() {
    if (modal1.style.display === 'block') {
        modal.style.display = 'none';
    }
});
loginButton.addEventListener('click', () => {
    closeAllModals();

    modal.style.display = 'block';
});
closeModal.addEventListener('click', () => {
    modal.style.display = 'none';
});
window.addEventListener('click', (event) => {

    if (event.target === modal) {
        modal.style.display = 'none';
    }

});