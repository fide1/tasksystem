@extends('frontend.layouts.master')
@section('title','Task-System || HOME PAGE')
@section('main-content')
<!-- Slider Area -->
<!-- Shop Login -->
    <section class="section">
        <div class="container">
            <div class="row"> 
                <div class="welcome col-md-12 col-sm-12 ">
                    <h1>Welcome to Task Managment System</h1>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->

@endsection

@push('styles')
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
    <style type="text/css">
        .welcome {
            text-align: center;
        }
    </style>
@endpush

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

@endpush
