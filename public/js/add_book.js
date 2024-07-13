document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('submit_button').addEventListener('click', () => {
        const title = document.getElementById('title').value;
        const author = document.getElementById('author').value;
        const fileInput = document.getElementById('preview_image');
        const file = fileInput.files[0];

        if (!title || !author || !file) {
            return;
        }

        const reader = new FileReader();
        reader.onloadend = async function () {
            const base64Image = reader.result.split(',')[1];

            fetch('/add_book', {
                method: 'POST', headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }, body: JSON.stringify({
                    title,
                    author,
                    preview_image: base64Image
                })
            },).then((response) => {
                window.location.href = '/';
            }).catch((err) => {
                console.log(err)
            })
        };

        reader.readAsDataURL(file);
    });
});
