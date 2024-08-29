<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengguna</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Pengguna</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Hobi</th>
                    <th>Gender</th>
                    <th>Lagu Favorit 1</th>
                    <th>Lagu Favorit 2</th>
                    <th>Lagu Favorit 3</th>
                    <th>Lagu Favorit 4</th>
                    <th>Lagu Favorit 5</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->age }}</td>
                    <td>{{ $user->hobby }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>{{ $user->favorite_songs_1}}</td>
                    <td>{{ $user->favorite_songs_2}}</td>
                    <td>{{ $user->favorite_songs_3}}</td>
                    <td>{{ $user->favorite_songs_4}}</td>
                    <td>{{ $user->favorite_songs_5}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
