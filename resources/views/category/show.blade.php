@extends('Admin.index')

@section('content')

    <div class="container-fluid" id="admin-category-container">
           
        <a href="category/create" class="btn btn-primary">Add new Category</a>
            <br><br>

        <div class="col-md-10" id="admin-category-container">
        <ul class="collection with-header">
            @foreach ($categories as $category)
            @if( is_null($category->parent_id))    
            <li class="collection-item blue">
                <h5 class="white-text">
                    {{ $category->category }}
                </h5>
                <li class="collection-item primary-color">
                    <div class="col-xs-3 col-sm-2 col-md-2">
                        <form method="post" action=" /category/{{$category->id}}" class="delete_form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="delete-btn">
                                <i class="zmdi zmdi-delete zmdi-hc-2x red-text"></i>
                            </button>
                        </form>
                    </div>
                    <a href="/category/{{$category->id}}/edit">
                        <i class="zmdi zmdi-edit zmdi-hc-2x white-text"></i>
                    </a>
                    <a href="{{ route('category.addsub', $category->id) }}" id="sub-category" class="pull-right white-text">+ Sub-Category</a>
                </li>
            </li>
            @endif
                @foreach ($category->children as $children)
                <li class="collection-item">
                        <a href="{{ route('category.editsub', $children->id) }}">
                            <i class="zmdi zmdi-edit zmdi-hc-2x green-text"></i>
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('category.products', $children->id) }}">
                            <i class="zmdi zmdi-eye zmdi-hc-2x "></i>
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;{{ $children->category }}
                        <a href="#!" class="secondary-content">
                            <form method="post" action="{{ route('category.deletesub', $children->id) }}" class="delete_form_sub">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="delete-btn-sub">
                                    <i class="zmdi zmdi-delete zmdi-hc-2x red-text"></i>
                                </button>
                            </form>
                        </a>
                </li>
                @endforeach
            @endforeach
        </ul>
        </div>

    </div>  <!-- close container -->

@endsection
