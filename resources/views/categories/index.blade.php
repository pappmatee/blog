@extends('layouts.app')

@section('content')
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbar name="Categories"/>
        <!-- End Navbar -->
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="container-fluid py-4">
                <div class="d-flex gap-2">
                    <div class="col-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
                                        <div class="d-flex flex-column">
                                            <label>Name</label>
                                            <div class="mb-3">
                                                <input type="text" name="name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column mb-3">
                                            <label>Parent</label>
                                            <div class="mb-3">
                                                <select name="parent" class="form-control">
                                                    <option selected disabled>Select a category...</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm mb-0">Add category</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                    <div class="col-6 col-md-6">
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 mb-xl-0 mb-4">
                                        <div class="d-flex flex-column">
                                            <h6 class="font-weight-bolder mb-3">Categories</h6>
                                            @foreach($categories as $category)
                                                <p class="mb-1">{{ $category['name'] }}</p>
                                                @if($category->subCategories() != null)
                                                    @foreach($category->subCategories as $subCategory)
                                                        <p class="mb-1">- {{ $subCategory['name'] }}</p>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
@endsection
