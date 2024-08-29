@extends('master')

@section('style')
    <style>
        .overlay-div{
            height: 100%;
            width: 100%;
            position:absolute;
            background-color: rgba(192,197,163,0.4)
        }
        .btn-primary{
            background: #b6bdad;
            border-color: black;
        }
        .btn-primary:hover{
            background: #b0b6a9;
            border-color: white;
        }
        .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
            background: #b5bbad;
            border-color: white;
        }

        body{
            min-height: 100%;
        }
    </style>
    <style>
        .bordered-div {
          border: 2px solid black; /* Mengatur border dengan ketebalan 2px dan warna hitam */
          padding: 10px; /* Menambahkan padding di dalam div */
          width: 300px; /* Lebar div */
          height: 200px; /* Tinggi div */
          margin: 20px; /* Jarak margin di sekitar div */
        }
      </style>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Temukan tombol "MASUK" berdasarkan ID
            var tombolMasuk = document.getElementById('MASUK');

            // Tambahkan event listener untuk mendengarkan klik pada tombol "MASUK"
            tombolMasuk.addEventListener('click', function() {
                // Arahkan pengguna ke halaman /dash (gantilah dengan URL yang sesuai)
                window.location.href = '/dash'; // Ganti '/dash.html' sesuai dengan nama halaman yang Anda inginkan
            });
        });
    </script>
@endsection

@section('content')
        <div class="d-flex flex-row min-vh-100">
            <div id="form" class="d-flex flex-column align-items-center col-6 my-auto">
                <h1>Masuk</h1>
                <form action="/cek" class="mx-auto w-50" method="POST">
                    @csrf
                    <div class="form-group my-2">
                        <input type="text" name="email" id="" placeholder="Email" class="form-control">
                    </div>
                    <div class="form-group my-2">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group my-2 d-grid">
                        <button id="tombolMasuk" class="btn btn-primary"><a href="{{url('/lay')}}">
                            MASUK
                        </button>
                        <script>
                            // Temukan tombol "MASUK" berdasarkan ID
                            var tombolMasuk = document.getElementById('tombolMasuk');

                            // Tambahkan event listener untuk mendengarkan klik pada tombol "MASUK"
                            tombolMasuk.addEventListener('click', function() {
                                // Arahkan pengguna ke halaman /dash (gantilah dengan rute yang sesuai)
                                window.location.href = '/dash';
                            });
                        </script>

                    </div>
                    <div class="text-center">
                        <h6>Belum Punya Akun?</h6>
                        <a href="{{url('/daftar')}}"><label style="color: blue;" for="Daftar">DAFTAR</label></a>
                    </div>
                </form>
            </div>
            <div id="gambar" class="d-flex align-items-center position-relative col-5" style="">
                {{-- <div class="overlay-div">

                </div> --}}
                <img src="{{ asset('img/musiksp.jpg') }}" alt="" class="mx-auto img-fluid">

            </div>
        </div>
@endsection
