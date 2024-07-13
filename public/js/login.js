document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('submit_login').addEventListener('click', () => {
        const password = document.getElementById('password').value;
        const login = document.getElementById('login').value;
        if (!password || !login) {
            return;
        }

        fetch('/login', {
            method: 'POST', headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }, body: JSON.stringify({
                email: login, password
            })
        },).then((response) => {
            if (!response.ok) {
                alert('Помилка під час заповнення полів')
                return;
            }
            window.location.href = '/';
        }).catch((err) => {
            console.log(err)
        })

    });

});
