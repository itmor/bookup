document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('burger-menu').addEventListener('click', function () {
        this.classList.toggle("close");
        document.querySelector('.header__menu').classList.toggle('active');
    });
});
