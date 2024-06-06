const container = document.getElementById('container-produk');
const keyword = document.getElementById('keyword-search');

keyword.addEventListener('keyup', async function () {
    const queryURL = 'result.php?keyword=' + keyword.value;
    const responses = await fetch(queryURL);
    container.innerHTML = await responses.text();
})