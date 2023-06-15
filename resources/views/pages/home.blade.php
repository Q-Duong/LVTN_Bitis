@extends('layout')
@section('content')
<section id="a" class="hero">
    <div id="slider">
        <a href="#" class="control_next">&gt;</a>
        <a href="#" class="control_prev">&lt;</a>
        <ul>
            @foreach ($getAllBanner as $key => $banner)
                <li><img src="{{ asset('uploads/banner/' . $banner->banner_image) }}"></li>
            @endforeach
        </ul>
    </div>

    <div class="slider_option">
        <input type="checkbox" id="checkbox">
        <label for="checkbox">Autoplay <a href="https://www.jqueryscript.net/slider/">Slider</a></label>
    </div>
</section>
@endsection