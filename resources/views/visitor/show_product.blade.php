@extends('layouts.app')

@section('content')

        <div class="container-fluid">

            <div class="col-md-12">

                <div class="col-xs-12 col-sm-12 col-md-8 gallery">
                    @if ($product->photos->count() === 0)
                        <p>No Images found for this Product.</p><br>
                        <img src="{{ asset('public/no-image-found.jpg') }}" alt="No Image Found Tag" id="Product-similar-Image">
                    @else
                        @foreach ($product->photos->slice(0, 8) as $photo)
                            <div class="col-xs-6 col-sm-4 col-md-3 gallery_image text-center">
                                <a href="{{asset($photo->path)}}" data-lity>
                                    <img src="{{asset($photo->thumbnail_path)}}" alt="Photo ID: {{ $photo->id  }}" data-id="{{ $photo->id }}" class="img-thumbnail">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="col-sm-12 col-md-4">
                    <h5 id="Product_Name">{{ $product->product_name }}</h5>
                    <br>
                    @if($product->reduced_price == 0)
                        <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $product->price }}</div>
                        <br>
                    @else
                        <div class="discount light-300 black-text medium-500" id="Product_Reduced-Price"><s>$ {{ $product->price }}</s></div>
                        <div class="green-text medium-500" id="Product_Reduced-Price">$ {{ $product->reduced_price }}</div>
                    @endif
                    <hr>

                    @if ($product->product_qty == 0)
                        <h5 class="text-center red-text">Sold Out</h5>
                        <p class="text-center"><b>Available: {{ $product->product_qty }}</b></p>
                       
                    @endif

                </div>

            </div>  <!-- close col-md-12 -->


            <div class="col-md-12">

                <div class="col-sm-12 col-md-8" id="Product-Description-Container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#product_description" aria-controls="home" role="tab" data-toggle="tab">DESCRIPTION</a></li>
                        
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="product_description">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>

                
            </div>  <!-- close col-md-12 -->

            <br><br><hr>

        </div>  <!-- close container-fluid -->

        <div class="container-fluid" id="comments-container">
            <div class="col-md-12">
                <div id="disqus_thread"></div>
            </div>
        </div>
@endsection