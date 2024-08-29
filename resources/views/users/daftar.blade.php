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
            background: #7BA644;
            border-color: black;
        }
        .btn-primary:hover{
            background: #A7DC64;
            border-color: white;
        }
        .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active {
            background: #A7DC64;
            border-color: white;
        }

        body{
            min-height: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-row min-vh-100">
        <div id="form" class="d-flex flex-column align-items-center col-6 my-auto">
            <h1>Daftar</h1>
            <form action="" class="mx-auto w-50">
                @csrf
                <div class="form-group my-2">
                    <input type="text" name="email" id="" placeholder="Email" class="form-control">
                </div>
                <div class="form-group my-2">
                    <input class="form-control" type="password" name="" id="password" placeholder="Password">
                </div>
                <div class="form-group my-2">
                    <input class="form-control" type="password" name="" id="re-password" placeholder="Re-Password">
                </div>
                <div class="form-group my-2 d-grid">
                    <button class="btn btn-primary">
                        <span>DAFTAR</span>
                    </button>
                </div>
                <div class="text-center">
                    <h6>Sudah Punya Akun?</h6>
                    <a href="{{url('/login')}}"><label style="color: blue;">MASUK</label></a>
                </div>

            </form>
        </div>
        <div id="gambar" class="d-flex align-items-center position-relative col-6" style="">
            <div class="overlay-div">

            </div>
            <img src="{{url('/img/kelor2.jpg')}}" alt="" class="mx-auto img-fluid ">

        </div>
    </div>
@endsection
