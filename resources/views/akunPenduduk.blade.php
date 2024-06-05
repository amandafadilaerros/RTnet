@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-body">
        {{-- <h5 class="card-title">Ubah Kata Sandi</h5> --}}
        <div class="col-md-6">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{url('/penduduk/akun')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="old_password" class="form-label">Password Lama</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" required>
                    <input type="checkbox" onclick="myFunction1()">Tampilkan Password
                    @error('old_password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    {{-- <span class="" onclick="myFunction1()">
                        <i class="fa fa-eye"></i>
                    </span> --}}
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <input type="checkbox" onclick="myFunction2()">Tampilkan Password
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    {{-- <div class="col-md-6"> --}}
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Kata sandi harus terdiri dari setidaknya satu angka, satu huruf kecil, satu huruf besar, dan setidaknya 8 karakter" oninput="checkPasswordMatch()">
                        <input type="checkbox" onclick="myFunction3()">Tampilkan Password
                        <div id="passwordMismatch" class="text-danger" style="display: none;">
                            Konfirmasi kata sandi tidak cocok dengan kata sandi baru.
                        </div>
                    {{-- </div> --}}
                </div>
                <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 90px; margin-bottom: 10px; background-color: #424874;">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password_confirmation").value;
        var mismatchDiv = document.getElementById("passwordMismatch");
        var submitButton = document.getElementById("submitButton");

        if (password != confirmPassword) {
            mismatchDiv.style.display = "block";
            submitButton.disabled = true;
        } else {
            mismatchDiv.style.display = "none";
            submitButton.disabled = false;
        }
    }
    function myFunction1() {
        var x = document.getElementById("old_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function myFunction2() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    function myFunction3() {
        var x = document.getElementById("password_confirmation");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
@endpush