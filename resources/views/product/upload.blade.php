@extends('admin.index')

@section('content')

    <div class="container">

 
        
        <a href="{{ url('product') }}" class="btn btn-danger">Back</a>
        <br><br>

        <div class="col-md-12">

            <h5 class="text-center">Upload Product Images for
                @foreach($product as $products)
                    <p>{{ $products->product_name }}</p>
                @endforeach
            </h5>

            <br>

                @if ($products->photos->count() > 3)
                    <p class="text-center"><b>Cannot upload more than 3 photos for one for One Product. Delete some photos to upload other photos.</b></p><br><br>
                @else
                    <form method="POST" action="/admin/product/{{$products->id}}/photo" class="dropzone" id="addProductImages" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    </form>
                    <p class="text-center"><span class="red-text">*</span> Only 3 photos will show up per product on products page</p>
            @endif


            <div class="col-md-12 gallery">
                @foreach ($products->photos->chunk(4) as $set)
                    <div class="row" id="image_row">
                        @foreach ($set as $photo)
                            <div class="col-xs-6 col-sm-3 col-md-3 gallery_image">
                                <label>{{ $photo->id }}</label>
                                    <div class="img-wrap">
                                        <form method="post" action="/admin/product/photos/{{ $photo->id }}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="close">&times;</button>
                                            <a href="{{asset($photo->path)}}" data-lity>
                                                <img src="{{asset($photo->thumbnail_path)}}" alt="" data-id="{{ $photo->id }}">
                                            </a>
                                        </form>
                                    </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <br><br>

                        <button class="btn btn-info btn-sm waves-effect waves-light" onclick="location.reload();">Show</button>
                  
            </div>

        </div> <!-- Close col-md-12 -->


        <div class="col-md-12 gallery" id="gallery">

            <hr>

            <br><br>

            <h6>Which Image do you want featured as the main Product Image for: {{ $products->product_name }}?</h6><br>


            <form method="post" action="/admin/product/add/featured/{{$products->id}}">
                {!! csrf_field() !!}
                @foreach($products->photos as $set)
                        <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
                            <div class="input-group">
                                <label>{{ $set->id }}&nbsp;&nbsp;&nbsp;</label>
                                <input type="checkbox" name="featured" value="{{ $set->id }}" {{ $set->featured === 1 ? "checked=checked" : "" }}><br>
                                @if($errors->has('featured'))
                                    <span class="help-block">{{ $errors->first('featured') }}</span>
                                @endif
                            </div>
                        </div>
                @endforeach

                <p class="small">* Select 1 only</p>

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Feature Image</button>
                </div>

            </form>

        </div> <!-- Close col-md-12 -->

    </div>  <!-- Close container -->

@endsection


@section('footer')

    <script type="application/javascript" src="{{ asset('js/libs/dropzone.js') }}"></script>

    <script>

        Dropzone.options.addProductImages = {
            paramName: 'file',
            maxFilesize: 2,
            maxFiles: 12,
            acceptedFiles: '.jpg, .jpeg, .png'
        }

    </script>

    <script>
        if(!$('#image_row').length){
            $('#gallery').hide();
        }
    </script>

@endsection
