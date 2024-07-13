document.addEventListener('DOMContentLoaded', () => {
    const rate = document.getElementById('rate');

    if (!rate) {
        return;
    }

    document.getElementById('submit_rate').addEventListener('click', () => {
        const rateValue = rate.value;

        fetch('/add_rate_to_book', {
            method: 'POST', headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }, body: JSON.stringify({
                book_id: rate.dataset.bookId,
                rate: rateValue
            })
        },).then((response) => {
            window.location.reload();
        }).catch((err) => {
            console.log(err)
        })
    });
});
