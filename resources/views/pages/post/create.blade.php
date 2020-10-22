@extends("layouts.layout")

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Create Post</h2>
                </div>
                <div class="card-body">
                    <form action="{{ $action }}" method="post">
                        @csrf

                        @include("pages.post._form")

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection