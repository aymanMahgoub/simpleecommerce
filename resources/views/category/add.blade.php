@extends('Admin.index')
@section('content')

<div class="container" id="admin-category-container">
        <br><br>
    <div class="col-sm-8 col-md-9" id="admin-category-container">
        <ul class="collection with-header">
            <form role="form" method="POST" action="/category">
                {{ csrf_field() }}
                <li class="collection-item blue">
                    <h4 class="white-text text-center">
                       Add Category
                    </h4>
                </li>
                <li class="collection-item">
                    <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="category" value="{{ old('category') }}" placeholder="Add New Category">
                        @if($errors->has('category'))
                            <span class="help-block">{{ $errors->first('category') }}</span>
                        @endif
                    </div>
                </li>
                <li class="collection-item blue">
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-success">Create Category</button>
                    </div>
                </li>
            </form>
        </ul>
    </div>

</div>

@endsection