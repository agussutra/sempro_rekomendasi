@extends('layout.main')
@section('judul')
@endsection

@section('script')
<script>
    const clientId = "41b880c6655c4097bc319efece8dd793";
    const clientSecret = "c80d4847177845fcae737cc9f7f3bbde";

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

        const data = await response.json();
        localStorage.setItem("token", data.access_token);
        localStorage.setItem("expires_in", (3600 * 1000) + Date.now());
    }

    if (!localStorage.getItem("token")) {
        getToken();
    }

    const token = localStorage.getItem("token");

    document.getElementById('searchInput').addEventListener('input', cekInput);

    let selectedSongs = [];
    const songInputs = document.querySelectorAll('.lagupilihan');
    const trackInputs = document.querySelectorAll('.idtrack');

    function getNextInput() {
        for (const input of songInputs) {
            if (input.value.trim() === '') {
                return input;
            }
        }
        return null;
    }
    function getNextInputTrack() {
        for (const input of trackInputs) {
            if (input.value.trim() === '') {
                return input;
            }
        }
        return null;
    }

    async function searchSongs() {
        const saatini = new Date();
        if (localStorage.getItem('expires_in') < saatini.getTime()) {
            await getToken();
        }
        const searchQuery = document.getElementById('searchInput').value;
        if (searchQuery.length < 3) {
            return;
        }
        const url = `https://api.spotify.com/v1/search?q=${searchQuery}&type=track`;

        const response = await fetch(url, {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });

        const data = await response.json();
        const searchResults = document.getElementById('searchResults');
        searchResults.innerHTML = '';

        data.tracks.items.forEach(item => {
            if (!selectedSongs.includes(item.name)) {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'search-input');
                listItem.textContent = `${item.artists[0].name} - ${item.name}`;
                listItem.addEventListener('click', () => {
                    const nextInput = getNextInput();
                    const nextTrack = getNextInputTrack();
                    if (nextInput) {
                        nextInput.value = `${item.artists[0].name} - ${item.name}`;
                        nextTrack.value = `${item.id}`;
                        selectedSongs.push({ artist: item.artists[0].name, song: item.name });
                        resetSearch();
                        // console.log(item);
                    }
                });
                searchResults.appendChild(listItem);
            }
        });
    }

    function resetSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchResults').innerHTML = '';
    }
    function cekInput(){
        if(document.getElementById('searchInput').value.length == 0){
            resetSearch();
        }
    }
</script>
@endsection

@section('style')
<style>
    body {
        background-color: #0f0b0b;
        font-family: Arial, sans-serif;
    }

    .container {
        background-color: #110f0f;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        max-width: 800px;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #f3f7f8;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
    }

    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #080505;
        font-weight: bold;
    }

    tbody tr:nth-child(even) {
        background-color: #131010;
    }

    .total-produksi {
        font-weight: bold;
        background-color: #e0e0e0;
    }
</style>
@endsection

@section('isi')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Rekomendasi Daftar Lagu Saat Belajar
      </h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
            <div class="container">
                <h1>Cari Rekomendasi Lagu</h1>

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="age">Umur:</label>
                        <input type="number" class="form-control" name="age" id="age" required>
                    </div>
                    <label for="Hobi">Hobi:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="1" id="checkSeniKreatif">
                        <label class="form-check-label" for="checkSeniKreatif">
                            Hobi Seni dan Kreatif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="2" id="checkOlahragaRekreasi">
                        <label class="form-check-label" for="checkOlahragaRekreasi">
                            Hobi Olahraga dan Rekreasi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="3" id="checkTeknologiDigital">
                        <label class="form-check-label" for="checkTeknologiDigital">
                            Hobi Teknologi dan Digital
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="4" id="checkKoleksi">
                        <label class="form-check-label" for="checkKoleksi">
                            Hobi Koleksi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="5" id="checkKuliner">
                        <label class="form-check-label" for="checkKuliner">
                            Hobi Kuliner
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="6" id="checkLiterasi">
                        <label class="form-check-label" for="checkLiterasi">
                            Hobi Literasi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="7" id="checkAlamLingkungan">
                        <label class="form-check-label" for="checkAlamLingkungan">
                            Hobi Alam dan Lingkungan
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="hobi[]" value="8" id="checkSosialVolunteering">
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
                        <label for="search_song">Lagu yang Membuat Anda Fokus Saat Belajar:</label>
                        <div class="input-group ">
                            <input type="text" class="form-control" id="searchInput" placeholder="Masukkan judul lagu">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="searchSongs()">Cari</button>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Cari Rekomendasi</button>
                </form>
            </div>
    </div>
    <!-- /.card-body -->

    <!-- /.card-footer-->
  </div>

@endsection
