<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formulir Pengguna Test</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .list-group-item {
            cursor: pointer;
        }

        .search-input:hover {
            background-color: rgb(0, 43, 171);
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        {{-- <a class="navbar-brand" href="#">Brand</a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="btn btn-primary" href="/lay">Cari Rekomendasi Lagu</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">Pengumpulan Data Latih</h3>
                    </div>
                    <div class="card-body">
                        {{-- <form action="{{ route('users.store') }}" method="POST"> --}}
                        @csrf
                        <div class="form-group">
                            <label for="age">Umur:</label>
                            <input type="number" class="form-control" name="age" id="age" required>
                        </div>
                        <label for="Hobi">Hobi:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="1"
                                id="checkSeniKreatif">
                            <label class="form-check-label" for="checkSeniKreatif">
                                Hobi Seni dan Kreatif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="2"
                                id="checkOlahragaRekreasi">
                            <label class="form-check-label" for="checkOlahragaRekreasi">
                                Hobi Olahraga dan Rekreasi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="3"
                                id="checkTeknologiDigital">
                            <label class="form-check-label" for="checkTeknologiDigital">
                                Hobi Teknologi dan Digital
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="4"
                                id="checkKoleksi">
                            <label class="form-check-label" for="checkKoleksi">
                                Hobi Koleksi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="5"
                                id="checkKuliner">
                            <label class="form-check-label" for="checkKuliner">
                                Hobi Kuliner
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="6"
                                id="checkLiterasi">
                            <label class="form-check-label" for="checkLiterasi">
                                Hobi Literasi
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="7"
                                id="checkAlamLingkungan">
                            <label class="form-check-label" for="checkAlamLingkungan">
                                Hobi Alam dan Lingkungan
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="hobi[]" value="8"
                                id="checkSosialVolunteering">
                            <label class="form-check-label" for="checkSosialVolunteering">
                                Hobi Sosial dan Volunteering
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select class="form-control" name="gender" id="gender" required>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="search_song">Cari Lagu:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" id="searchInput"
                                    placeholder="Masukkan judul lagu">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"
                                        onclick="searchSongs()">Cari</button>
                                </div>
                            </div>
                        </div>
                        <div id="searchResults"></div>
                        <div class="my-4"><b>List Lagu Yang Disukai</b></div>
                        <div class="mt-3 table-responsive">
                            <table class="table tableLagu" id="tableLagu">
                                <thead>
                                    <th>Artist</th>
                                    <th>Song</th>
                                    <th>Valency</th>
                                    <th>Energy</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="btn btn-primary" onclick="saveData()">Simpan</button>
                        </div>
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function getToken() {
            const params = new URLSearchParams();
            params.append("grant_type", "client_credentials");
            params.append("client_id", "41b880c6655c4097bc319efece8dd793");
            params.append("client_secret", "c80d4847177845fcae737cc9f7f3bbde");

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
            const data = await response.json();
            localStorage.setItem("token", data.access_token);
            localStorage.setItem("expires_in", (3600 * 1000) + Date.now());
        }

        if (!localStorage.getItem("token")) {
            getToken();
        }

        const token = localStorage.getItem("token");

        async function searchSongs() {
            const saatini = new Date();

            if (parseInt(localStorage.getItem('expires_in'), 10) < saatini.getTime()) {
                await getToken();
            }
            const searchQuery = document.getElementById('searchInput').value;
            const url =
                `https://api.spotify.com/v1/search?q=${encodeURIComponent(searchQuery < 3 ? '' : searchQuery)}&type=track`;

            const response = await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            const data = await response.json();
            const searchResults = document.getElementById('searchResults');

            searchResults.innerHTML = '';

            const table = document.createElement('table');
            table.className = 'table table-striped';

            table.innerHTML = `
            <thead>
                <tr>
                    <th>Artist</th>
                    <th>Song</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                ${data.tracks.items.map((item) => `
                                                                         <tr>
                                                                            <td>${item.artists[0].name}</td>
                                                                            <td>${item.name}</td>
                                                                            <td>
                                                                               <button type="button" class="btn btn-primary btn-sm" data-item='${JSON.stringify(item)}' onclick="return saveTrack(this)">+</button>
                                                                            </td>
                                                                        </tr>
                                                                        `).join('')}
            </tbody>
        `;
            searchResults.appendChild(table);
        }

        async function saveTrack(item) {
            const trackCombination = [];
            const itemData = JSON.parse(item.getAttribute('data-item'));

            if (itemData) {
                const audioFeaturesUrl = `https://api.spotify.com/v1/audio-features/${itemData.id}`;
                try {
                    const response = await fetch(audioFeaturesUrl, {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        }
                    });
                    const audioFeatures = await response.json();
                    trackCombination.push({
                        artisName: itemData.artists[0].name,
                        songName: itemData.name,
                        energy: audioFeatures.energy,
                        valence: audioFeatures.valence
                    });
                } catch (error) {
                    console.error(`Error fetching audio features for ${itemData.name}:`, error);
                }
            }

            if (trackCombination.length > 0) {
                const newRow = document.createElement('tr');

                // Baris untuk artis
                newRow.appendChild(Object.assign(document.createElement('td'), {
                    textContent: trackCombination[0].artisName
                }));

                // Baris untuk lagu
                newRow.appendChild(Object.assign(document.createElement('td'), {
                    textContent: trackCombination[0].songName
                }));

                // Baris untuk valence
                newRow.appendChild(Object.assign(document.createElement('td'), {
                    textContent: trackCombination[0].valence
                }));

                // Baris untuk energy
                newRow.appendChild(Object.assign(document.createElement('td'), {
                    textContent: trackCombination[0].energy
                }));

                // baris button delete
                newRow.appendChild(Object.assign(document.createElement('td'), {
                    innerHTML: `<button type="button" class="btn btn-danger btn-sm" onclick="return deleteTrack(this)">-</button>`,
                }))

                document.getElementById('tableLagu').querySelector('tbody').appendChild(newRow);
            }
            return false;
        }


        function deleteTrack(item) {
            item.parentElement.parentElement.remove();
            return false;
        }

        function resetSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchResults').innerHTML = '';
        }

        function getUpData() {
            const dataHoby = [];
            const checkboxes = document.querySelectorAll('input[name="hobi[]"]');
            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    dataHoby.push({
                        hobi: checkbox.value
                    });
                }
            })

            return {
                age: age,
                gender: gender,
                hobi: dataHoby
            };
        }

        async function saveData() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            const rowTable = document.getElementById('tableLagu').querySelector('tbody').children;
            const dataSong = [];

            Array.from(rowTable).forEach(row => {
                const artist = row.children[0].textContent;
                const song = row.children[1].textContent;
                const valence = row.children[2].textContent;
                const energy = row.children[3].textContent;
                dataSong.push({
                    artist,
                    song,
                    valence,
                    energy
                });
            })

            if (dataSong.length === 0 || dataSong.length > 5) {
                return alert("Data Lagu Maksimal 5");
            }

            try {
                // deklarasi variabel
                const dataTrack = {
                    umur: getUpData().age,
                    gender: getUpData().gender,
                    hobi: getUpData().hobi,
                    dataSong: dataSong,
                };

                // kirim data ke controller
                const response = await fetch('/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(dataTrack),
                });

                // console.log(dataTrack);
                

                // Pesan sukses dari controller
                const contentType = response.headers.get('Content-Type')
                if (contentType && contentType.includes('application/json')) {
                    const result = await response.json();
                    alert(result.message);
                } else {
                    const text = await response.text();
                    alert('Unexpected response from server.');
                }

            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min
