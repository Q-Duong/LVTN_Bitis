@extends('layout')
@section('content')

{{-- <div class="slideshow-container">

    @foreach ($getAllBanner as $key => $banner)
    <div class="mySlides fade .owl-carousel active" style="display: block;">
      <div class="numbertext">1 / 3</div>
      <a ><img src="{{ asset('uploads/banner/' . $banner->banner_image) }}" class="imgslide" style="width:100%"></a>
      <div class="text">Caption Text</div>
    </div>
    @endforeach

    
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a id="next" class="next" onclick="plusSlides(1)">❯</a>
  </div>
  <br>

  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot active" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
  <br>


  <button id="stopAutoplayButton" onclick="stopAutoplay();">Stop</button> --}}
  <section id="a" class="hero">
    <div class="hero__slider owl-carousel">
    @foreach ($getAllBanner as $key => $banner)
        <div class="hero__items set-bg active" data-setbg="{{ asset('uploads/banner/' . $banner->banner_image) }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <a href="{{URL::to('/')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fas fa-phone    "></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach    
    </div>
</section>

@endsection