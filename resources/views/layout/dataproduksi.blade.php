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
        font-family: Arial, sans-serif;
        /* background-color: #f5f5f5; */
        margin: 0;
        padding: 0;
    }

    .container {
        /* background-color: #e5eade; */
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
    }

    h1 {
        color: #f2e9e9;
        text-align: center;
    }

    label {
        font-weight: ;
        /* color: #090808; */
    }

    .form-control {
        /* border: 1px solid #cccccc; */
        border-radius: 5px;
        padding: 10px;
        width: 100%;
        margin-bottom: 10px;
    }

    .btn-primary {
        /* background-color: #A7DC64; */
        border: none;
        /* color: #ffffff; */
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        /* background-color: #A7DC64; */
    }
     body{
            min-height: 100%;
        }
</style>
@endsection

@section('isi')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">
        Ini Adalah Halaman Admin
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
        <div >
        <div class="d-flex flex-row">

            <div class="container">
                <h1 class="mt-5">Admin</h1>
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Parameter Baru</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="parameter">Parameter:</label>
                                <input type="text" class="form-control" name="parameter" id="parameter" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

</div>
    </div>
    <!-- /.card-body -->

    <!-- /.card-footer-->
  </div>

@endsection
