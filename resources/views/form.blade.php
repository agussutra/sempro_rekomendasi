<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>
<body>

<form action="{{ route('submit') }}" method="post">
    @csrf
    <div>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
    </div>
    <div>
        <label for="umur">Umur:</label>
        <input type="number" id="umur" name="umur" required>
    </div>
    <div>
        <label for="hobi">Hobi:</label>
        <input type="text" id="hobi" name="hobi" required>
    </div>
    <div>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    <div>
        <label for="lagu">Lagu:</label>
        <input type="text" id="searchInput" placeholder="Cari Lagu">
        <ul id="searchResults"></ul>
        <input type="hidden" id="selectedLagu" name="lagu[]" value="">
    </div>
    <button type="submit">Submit</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const selectedLagu = document.getElementById('selectedLagu');

        searchInput.addEventListener('input', function () {
            searchResults.innerHTML = '';
            const query = searchInput.value.trim();
            if (query.length === 0) return;

            fetch(`https://api.spotify.com/v1/search?q=${query}&type=track`)
                .then(response => response.json())
                .then(data => {
                    data.tracks.items.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item.name;
                        li.addEventListener('click', function () {
                            selectedLagu.value += (selectedLagu.value ? ',' : '') + item.name;
                            this.remove();
                        });
                        searchResults.appendChild(li);
                    });
                })
                .catch(error => console.error('Error searching:', error));
        });
    });
</script>

</body>
</html>
