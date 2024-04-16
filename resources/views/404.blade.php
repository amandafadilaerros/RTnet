@extends('layouts.template')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container">
      <div class="row mb-12">
        <div class="col-sm-12">
          <h1>Oops...</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="error-message">
                <i class="fas fa-exclamation-triangle error-icon"></i>
                <p>Maaf, halaman yang Anda cari tidak ditemukan.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection


@push('css')
<style>
    /* CSS untuk pesan 404 */
    .error-message {
        text-align: center;
        margin-top: 50px;
        font-size: 24px;
        color: #555;
    }

    .error-icon {
        font-size: 100px;
        color: #ff6347;
        /* Warna merah */
    }

    .error-message p {
        margin-top: 20px;
        font-size: 18px;
        color: #777;
    }

    .error-message a {
        color: #007bff;
        /* Warna biru */
        text-decoration: none;
    }

    .error-message a:hover {
        text-decoration: underline;
    }
</style>
@endpush