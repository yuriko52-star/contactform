document.querySelectorAll('.detail-link').forEach(link => {
    link.addEventListener('click', async (e) => {
        e.preventDefault();
        console.log('clicked'); 

        const id = link.dataset.id;
        const url = link.dataset.url;
        const response = await fetch(url);

        if (!response.ok) {
            console.error('HTTP error', response.status);
            const text = await response.text();
            console.error(text);
            return;
        }
        const data = await response.json();

        document.getElementById('modal-name').textContent = data.first_name + ' ' + data.last_name;
        document.getElementById('modal-email').textContent = data.email;
        document.getElementById('modal-address').textContent = data.address;
        document.getElementById('modal-building').textContent = data.building;
        document.getElementById('modal-category').textContent = data.category;
        document.getElementById('modal-detail').textContent = data.detail;
        document.getElementById('modal-gender').textContent = data.gender;
        document.getElementById('modal-tel').textContent = data.tel;

        // ★ 削除ボタンにIDを渡す
        // これがないとエラーになる
        const deleteBtn = document.getElementById('deleteBtn');
        deleteBtn.dataset.id = id;
        document.getElementById('modal').classList.remove('hidden');

    })
})
document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('modal').classList.add('hidden');
});
// 削除処理
document.getElementById('deleteBtn').addEventListener('click', async () => {
    if (!confirm('本当に削除しますか？')) return;

    const id = document.getElementById('deleteBtn').dataset.id;
    console.log('削除ID:', id);
    const response = await fetch(`/contacts/${id}`, {
        
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    });
    const result = await response.json();
    if (result.success) {
        document.getElementById('modal').classList.add('hidden');
        document.querySelector(`tr[data-id="${id}"]`).remove();
    }
});

