<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<style>
    .table-responsive {
    overflow-x: auto;
}

.table th, .table td {
    vertical-align: middle;
}

.table th {
    text-align: center;
}
.table td {
    text-align: center;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

</style>
<body>
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Hobi</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Lagu</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tampilan as $t)
                <tr>
                    <td>{{ $t->nama }}</td>
                    <td>{{ $t->umur }}</td>
                    <td>{{ $t->hobi }}</td>
                    <td>{{ $t->gender }}</td>
                    <td>{{ $t->lagu }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
