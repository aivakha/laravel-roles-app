<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('posts.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="articleTitle">Title</label>
                        <input type="text" class="form-control" name="title" id="articleTitle">
                    </div>
                    <div class="form-group">
                        <label for="articleText">Text</label>
                        <textarea class="form-control" name="text" id="articleText" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
