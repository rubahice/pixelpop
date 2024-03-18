@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-slide="false">

    <div class="carousel-inner">
        @foreach ($sliders as $key => $sliderItem)
        <div class="carousel-item {{ $key == 0 ? 'active':'' }} active">
            @if ($sliderItem->image)
            <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="...">
            @endif

            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <!-- slide title dan slide desc opsional -->
                    {{-- <h1>
                        {!! $sliderItem->title !!}
                    </h1>
                    <p>
                        {!! $sliderItem->description !!}
                    </p> --}}
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Wellcome to {{ config('app.name') }}</h4>
                    <div class="underline mx-auto"></div>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod at molestiae
                        fugiat optio dolor laudantium accusamus tempora rem atque sunt, nulla eum magnam
                        repellendus. Quidem voluptatem id quae rerum? Voluptas culpa quas saepe soluta deserunt
                        fugiat atque hic! Exercitationem accusamus ex ratione quos in expedita autem porro? Explicabo,
                        quidem omnis.
                    </p>
                </div>
            </div>
        </div>
  </div>

  <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline mb-4"></div>
                </div>

                @if($trendingProducts)
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme four-carousel">
                        @foreach ($trendingProducts as $productItem)
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img">
                                            <label class="stock bg-danger"><i class="fa-solid fa-fire"></i> Trending</label>

                                        @if ($productItem->productImages->count() > 0)
                                            <a
                                                href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                    alt="{{ $productItem->name }}">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productItem->brand }}</p>
                                        <h5 class="product-name">
                                            <a
                                                href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                {{ $productItem->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span
                                                class="selling-price">Rp.{{ number_format($productItem->selling_price) }}</span>
                                            <span
                                                class="original-price">Rp.{{ number_format($productItem->original_price) }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Products Available</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
  </div>

  <div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals
                    <a href="{{ url('new-arrivals') }}" class="btn btn-warning float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>

            @if($newArrivalsProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach ($newArrivalsProducts as $productItem)
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>

                                    @if ($productItem->productImages->count() > 0)
                                        <a
                                            href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                            <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                alt="{{ $productItem->name }}">
                                        </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $productItem->brand }}</p>
                                    <h5 class="product-name">
                                        <a
                                            href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                            {{ $productItem->name }}
                                        </a>
                                    </h5>
                                    <div>
                                        <span
                                            class="selling-price">Rp.{{ number_format($productItem->selling_price) }}</span>
                                        <span
                                            class="original-price">Rp.{{ number_format($productItem->original_price) }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No New Arrivals Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Featured Products
                    <a href="{{ url('featured-products') }}" class="btn btn-warning float-end">View More</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>

            @if($featuredProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach ($featuredProducts as $productItem)
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">
                                        <label class="stock bg-danger">New</label>

                                    @if ($productItem->productImages->count() > 0)
                                        <a
                                            href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                            <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                alt="{{ $productItem->name }}">
                                        </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $productItem->brand }}</p>
                                    <h5 class="product-name">
                                        <a
                                            href="{{ url('/collections/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                            {{ $productItem->name }}
                                        </a>
                                    </h5>
                                    <div>
                                        <span
                                            class="selling-price">Rp.{{ number_format($productItem->selling_price) }}</span>
                                        <span
                                            class="original-price">Rp.{{ number_format($productItem->original_price) }}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>No Featured Products Available</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection



@section('script')

<script>
    $('.four-carousel').owlCarousel({
        loop:true,
        margin:10,
        dots:true,
        nav:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    })
</script>

@endsection

