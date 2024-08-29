<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Pengumpulan Data Latih</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <br><br><br>
    <div class="text-center">
        <h1>Form Pengumpulan Data Latih</h1>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 shadow p-4">
                <form id="formData">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" id="nama" class="form-control" placeholder="Masukkan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="umur" class="form-label">Umur:</label>
                        <input type="number" id="umur" class="form-control" placeholder="Masukkan Umur">
                    </div>
                    <div class="mb-3">
                        <label for="hobi" class="form-label">Hobi:</label>
                        <input type="text" id="hobi" class="form-control" placeholder="Masukkan Hobi">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender:</label>
                        <select id="gender" class="form-select">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 shadow p-4">
                <input type="text" id="searchInput" class="form-control shadow-none" placeholder="Cari Lagu">
                <ul id="searchResults" class="list-group mt-3" style="max-height:300px; overflow-y:scroll"></ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const clientId = "<YOUR_CLIENT_ID>"; // Ganti dengan Client ID Anda
        const clientSecret = "<YOUR_CLIENT_SECRET>"; // Ganti dengan Client Secret Anda

        let token = null;

        async function getToken() {
            const params = new URLSearchParams();
            params.append("grant_type", "client_credentials");
            params.append("client_id", clientId);
            params.append("client_secret", clientSecret);

            const response = await fetch(
                "https://accounts.spotify.com/api/token",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: params.toString(),
                }
            );

            const data = await response.json();
            token = data.access_token;
        }

        async function searchSongs() {
            const searchQuery = document.getElementById('searchInput').value.trim();
            const url = `https://api.spotify.com/v1/search?q=${searchQuery}&type=track`;

            const response = await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            });

            const data = await response.json();
            const searchResults = document.getElementById('searchResults');
            searchResults.innerHTML = '';

            data.tracks.items.forEach(item => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');
                listItem.textContent = `${item.name} - ${item.artists[0].name}`;
                searchResults.appendChild(listItem);
            });
        }

        document.getElementById('searchInput').addEventListener('input', searchSongs);

        document.getElementById('formData').addEventListener('submit', async function(event) {
            event.preventDefault();

            const nama = document.getElementById('nama').value.trim();
            const umur = document.getElementById('umur').value.trim();
            const hobi = document.getElementById('hobi').value.trim();
            const gender = document.getElementById('gender').value.trim();

            // Kirim data ke server Anda atau lakukan yang lain sesuai kebutuhan
            console.log('Nama:', nama);
            console.log('Umur:', umur);
            console.log('Hobi:', hobi);
            console.log('Gender:', gender);
        });

        getToken(); // Ambil token pertama kali
    </script>
</body>
</html>
