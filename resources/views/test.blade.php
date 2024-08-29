<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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
    <div class="container mt-5">
        <div class="form-group">
            <label for="">Cari Lagu</label>
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control shadow-none" placeholder="Cari Lagu">
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary" onclick="searchSongs()">Cari</button>
                </div>
            </div>
        </div>
        <div id="searchResults"></div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary float-right" onclick="saveData()">Simpan</button>
       </div>
    </div>
</body>

</html>
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
    // console.log(token);

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

        if (parseInt(localStorage.getItem('expires_in'), 10) < saatini.getTime()) {
            await getToken();
        }

        const searchQuery = document.getElementById('searchInput').value;

        if (searchQuery.length < 3) {
            return;
        }

        const url = `https://api.spotify.com/v1/search?q=${encodeURIComponent(searchQuery)}&type=track`;


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
                    <td><input type="checkbox" class="action-checkbox" data-item='${JSON.stringify(item)}'></td>
                </tr>
            `).join('')}
        </tbody>
    `;
        searchResults.appendChild(table);

        document.querySelectorAll('.action-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    handleAction(this);
                }
            });
        });
    }

    async function handleAction(data) {
        const item = JSON.parse(data.getAttribute('data-item'));
        const audioFeaturesUrl = `https://api.spotify.com/v1/audio-features/${item.id}`;

        try {
            const response = await fetch(audioFeaturesUrl, {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                }
            });

            const audioFeatures = await response.json();
        } catch (error) {
            console.error('Error fetching audio features:', error);
        }
    }

    async function saveData() {
        const selectedItems = []
        const checkboxes = document.querySelectorAll('.action-checkbox');

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const item = JSON.parse(checkbox.getAttribute('data-item'));
                selectedItems.push({
                    id: item.id,
                    artis: item.artists[0].name,
                    song: item.name
                });
            }
        })

        if (selectedItems.length > 0) {
            const trackCombination = [];

            for (const item of selectedItems) {
                const audioFeaturesUrl = `https://api.spotify.com/v1/audio-features/${item.id}`;

                try {
                    const response = await fetch(audioFeaturesUrl, {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        }
                    })
                    const audioFeatures = await response.json();

                    trackCombination.push({
                        ...item,
                        energy: audioFeatures.energy,
                        valence: audioFeatures.valence
                    })
                } catch (error) {
                    console.error(`Error fetching audio features for ${item.name}:`, error);
                }
            }
        } else {
            console.log("No items selected");
        }
    }

    function resetSearch() {
        document.getElementById('searchInput').value = '';
        document.getElementById('searchResults').innerHTML = '';
    }

    function cekInput() {
        if (document.getElementById('searchInput').value.length == 0) {
            resetSearch();
        }
    }
</script>
