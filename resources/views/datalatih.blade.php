<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .list-group-item:hover {
            background-color: grey;
        }
    </style>
</head>
<body>
    <br><br><br>
    <div class="text-center">
        <h1>Form Pengumpulan Data Latih</h1>
    </div>
    <br>
    <form id="formData" action="{{ url('/submit') }}" method="POST">
    <div class="container d-flex justify-content-center">
        <div class="col-6 shadow p-4">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama:</label>
                    <input name="nama" type="text" id="nama" class="form-control" placeholder="Masukkan Nama">
                </div>
                <div class="mb-3">
                    <label for="umur" class="form-label">Umur:</label>
                    <input name="umur" type="number" id="umur" class="form-control" placeholder="Masukkan Umur">
                </div>
                <div class="mb-3">
                    <label for="hobi" class="form-label">Hobi:</label>
                    <input name="hobi" type="text" id="hobi" class="form-control" placeholder="Masukkan Hobi">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <select name="gender" id="gender" class="form-select">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>


        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="col-6 shadow p-4">
            <input type="text" id="searchInput" class="form-control shadow-none" placeholder="Cari Lagu">
            <ul id="searchResults" class="list-group mt-3" style="max-height:300px; overflow-y:scroll; cursor:pointer;"></ul>
            <br><br>
            <!-- Blade Form -->
            <div class="mb-3">
                <label for="lagu1" class="form-label">Lagu Pilihan:</label>
                <input name="lagu1" type="text" id="lagupilihan1" class="form-control lagupilihan" placeholder="Lagu Pilihan">
            </div>
            <div class="mb-3">
                <input name="lagu2" type="text" id="lagupilihan2" class="form-control lagupilihan" placeholder="Lagu Pilihan">
            </div>
            <div class="mb-3">
                <input name="lagu3" type="text" id="lagupilihan3" class="form-control lagupilihan" placeholder="Lagu Pilihan">
            </div>
            <div class="mb-3">
                <input name="lagu4" type="text" id="lagupilihan4" class="form-control lagupilihan" placeholder="Lagu Pilihan">
            </div>
            <div class="mb-3">
                <input name="lagu5" type="text" id="lagupilihan5" class="form-control lagupilihan" placeholder="Lagu Pilihan">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
const clientId = "41b880c6655c4097bc319efece8dd793"; // Your client id
const clientSecret = "c80d4847177845fcae737cc9f7f3bbde"; // Your secret

        //getToken();

async function getToken() {
    const params = new URLSearchParams();
    params.append("grant_type", "client_credentials");
    params.append("client_id", clientId);
    params.append("client_secret", clientSecret);

    const parameter = {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: params.toString(),
    };

    const response = await fetch(
        "https://accounts.spotify.com/api/token",
        parameter
    );

    // SEMUA DATA TOKEN MU ADA DI VARIABLE data
    const data = await response.json();
    // GUNAKAN CONSOLE.LOG untuk mengecek isinya
    // console.log(data);

    // SIMPAN TOKEN KE LOCAL STORAGE
    localStorage.setItem("token", data.access_token);
    localStorage.setItem("expires_in",(3600*1000) + Date.now());
    //console.log('gen token');
}

        // BUATKAN KONDISI, JIKA TOKEN NYA BELUM ADA DI LOCAL STORAGE, MAKA JALANKAN FUNGSI getToken()
if (!localStorage.getItem("token")) {
    getToken();
}


        // LOCAL STORAGE ADALAH TEMPAT UNTUK MENYIMPAN DATA DI BROWSER.
        //  DATA YANG DISIMPAN DI LOCAL STORAGE AKAN SELALU ADA, BAIK KETIKA KITA REFRESH HALAMAN, TUTUP BROWSER,
        // BAHKAN KETIKA KITA MATIKAN KOMPUTER. DATA YANG DISIMPAN DI LOCAL STORAGE AKAN TETAP ADA HINGGA KITA MENGHAPUSNYA

// Mendapatkan token dari local storage
const token = localStorage.getItem("token");
document.getElementById('searchInput').addEventListener('input', searchSongs);



// Array untuk menyimpan lagu-lagu pilihan
let selectedSongs = [];

// Ambil inputan lagu pilihan
const songInputs = document.querySelectorAll('.lagupilihan');

// Tambahkan event listener untuk setiap input lagu pilihan
songInputs.forEach(input => {
    input.addEventListener('input', () => {
        // Cek apakah input sudah diisi
        if (input.value.trim() !== '') {
            // Jika belum mencapai 5 lagu yang dipilih, tambahkan ke array selectedSongs
            if (selectedSongs.length < 5) {
                selectedSongs.push(input.value);
            } else {
                // Jika sudah mencapai 5 lagu, hapus lagu paling awal dari array dan tambahkan yang baru
                selectedSongs.shift();
                selectedSongs.push(input.value);
            }
        }
    });
});

// Fungsi untuk mendapatkan input berikutnya yang masih kosong
function getNextInput() {
    for (const input of songInputs) {
        if (input.value.trim() === '') {
            return input;
        }
    }
    return null;
}

async function searchSongs(props) {
    saatini = new Date();
    if(localStorage.getItem('expires_in')>saatini.getTime()){
        getToken();
    }
    const searchQuery = document.getElementById('searchInput').value;
    if(searchQuery.length < 3){
        console.log(localStorage.getItem())
        return;
    }
    const url = `https://api.spotify.com/v1/search?q=${searchQuery}&type=track`;

    const response = await fetch(url, {
        headers: {
            'Authorization': 'Bearer ' + token
        }
    });

    const data = await response.json();

    // Bersihkan daftar hasil pencarian sebelum menambahkan hasil baru
    const searchResults = document.getElementById('searchResults');
    searchResults.innerHTML = '';

    // Tampilkan hasil pencarian dalam daftar
    data.tracks.items.forEach(item => {
        const listItem = document.createElement('li');
        listItem.classList.add('list-group-item');
        listItem.textContent = item.artists[0].name + " - " + item.name;
        listItem.addEventListener('click', () => {
            // Ketika item di-klik, masukkan nama lagu ke dalam input nama
            const nextInput = getNextInput();
            if (nextInput) {
                nextInput.value = item.name;
                // Setiap kali input diisi, perbarui array selectedSongs
                selectedSongs = [];
                songInputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        selectedSongs.push(input.value);
                    }
                });
            }
        });
        searchResults.appendChild(listItem);
    });
}
    </script>
</body>
</html>
