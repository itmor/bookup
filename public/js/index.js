document.addEventListener('DOMContentLoaded', () => {
    const updateBooksButton = document.getElementById('update_books');

    if (updateBooksButton) {
        const updateBooks = () => {
            updateBooksButton.click();
        };

        setInterval(updateBooks, 60000);

        updateBooksButton.addEventListener('click', () => {
            const lastBookId = updateBooksButton.getAttribute('data-last-book-id');
            const url = `/get-new-books/${lastBookId}`;
            const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenElement ? csrfTokenElement.getAttribute('content') : '';

            fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
                .then(response => response.json())
                .then(data => {
                    const newBooks = data.new_books;
                    const container = document.querySelector('.row-books');

                    newBooks.forEach(book => {
                        const bookElement = document.createElement('div');
                        bookElement.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-4');
                        bookElement.innerHTML = `
                        <div class="book">
                            <a class="book__link" href="/book/${book.id}"></a>
                            <div>
                                <img src="data:image/jpeg;base64,${book.preview_image}" alt="${book.title}" width="100%">
                            </div>
                            <div>Ім'я: ${book.title}</div>
                            <div>Автор книги: ${book.author}</div>
                            <div>Дата: ${book.created_at}</div>
                            <div>Рейтинг: ${book.average_rating > 0 ? `${book.average_rating}/5` : 'Рейтинг вiдсутнiй'}</div>
                        </div>
                    `;

                        container.insertBefore(bookElement, container.firstChild);
                    });

                    while (container.childElementCount > 10) {
                        container.removeChild(container.lastChild);
                    }

                    if (newBooks.length > 0) {
                        updateBooksButton.setAttribute('data-last-book-id', newBooks[newBooks.length - 1].id);
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        });
    }
});
