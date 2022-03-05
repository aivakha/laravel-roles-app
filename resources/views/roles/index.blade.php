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

                <a href="{{route('roles.create')}}" class="btn mb-2 btn-success">Add new role</a>

                @foreach($roles as $role)

                    <div class="card">
                        <div class="card-header">Featured</div>
                        <div class="card-body">
                            <h5 class="card-title">{{$role->name}}</h5>
                            <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary">Edit</a>
                            <form method="POST" action="{{route('roles.destroy', $role->id)}}" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>
