@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
       
                @foreach($products as $product)
                    <div class="col-md-12 wow slideInLeft" id="product-sub-container">
                        <div class="col-md-4 text-center hoverable">
                            <a href="{{ route('show.product', $product->product_name) }}">
                            @if ($product->photos->count() === 0)
                                    <img src="{{ asset('public/no-image-found.jpg') }}" alt="No Image Found Tag" id="Product-similar-Image">
                            @else
                                @if ($product->featuredPhoto)
                                    <img src="{{asset( $product->featuredPhoto->thumbnail_path )}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" />
                                @elseif(!$product->featuredPhoto)
                                    <img src="{{asset( $product->photos->first()->thumbnail_path)}}" alt="Photo" />
                                @else
                                    N/A
                                @endif
                            @endif
                            </a>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('show.product', $product->product_name) }}">
                            <h5 class="center-on-small-only">{{ $product->product_name }}</h5>
                            <p style="font-size: .9em;">{!! nl2br(str_limit($product->description, $limit = 200, $end = '...')) !!}</p>
                            </a>
                        </div>
                        
                    </div>
                @endforeach
                {{$products->links()}}
        </div>
    </div>
</div>
@endsection
