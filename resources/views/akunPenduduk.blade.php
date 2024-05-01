@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-body">
        {{-- <div class="col-md-6"> --}}
        <form method="POST" action="{{ url('/penduduk/akun') }}" class="form-horizontal">
            @csrf
            {{ method_field('PUT') }}
            <div class="mb-3">
                <div class="form-group row">
                    <label for="old_password" class="col-1 control-label col-form-label text-right">Password Lama</label>
                    <div class="col-11">
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                        <input type="checkbox" onclick="myFunction1()">Tampilkan Password
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-1 control-label col-form-label">Password</label>
                    <div class="col-11">
                        <input type="password" class="form-control" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Kata sandi harus terdiri dari setidaknya satu angka, satu huruf kecil, satu huruf besar, dan setidaknya 8 karakter" oninput="checkPasswordMatch()">
                        <input type="checkbox" onclick="myFunction2()">Tampilkan Password
                        {{-- @error('password')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @else
                            <small class="form-text text-muted">Leave blank if you don't want to change the user password.</small>
                        @enderror --}}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-1 control-label col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-11">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required oninput="checkPasswordMatch()">
                        <div id="passwordMismatch" class="text-danger" style="display: none;">
                            Konfirmasi kata sandi tidak cocok dengan kata sandi baru.
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-11 offset-1">
                        <button type="submit" class="btn btn-primary" style="border-radius: 20px; width: 90px; margin-bottom: 10px; background-color: #424874;">Simpan</button>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
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
</script>
@endpush

