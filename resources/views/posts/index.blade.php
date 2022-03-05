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

                @if (auth()->user()->can('add posts'))
                    <a href="{{route('posts.create')}}" class="btn mb-2 btn-success">Add new article</a>
                @endif

                @if (auth()->user()->can('show posts'))
                    @foreach($posts as $post)
                        <div class="card">
                            <div class="card-header">Featured</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text">
                                    {{$post->text}}
                                </p>
                                @if (auth()->user()->can('edit posts'))
                                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary">Edit</a>
                                @endif
                                @if (auth()->user()->can('delete posts'))
                                    <form method="POST" action="{{route('posts.destroy', $post->id)}}"
                                          style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                @endif
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
