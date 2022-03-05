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

                <a href="{{route('users.create')}}" class="btn mb-2 btn-success">Add new user</a>

                @foreach($users as $user)

                    <div class="card mt-3">
                        <div class="card-header">{{$user->name}} <span style="font-size: 14px">{{$user->email}}</span></div>
                        <div class="card-body">
                            <p>Role:
                                @foreach($user->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            </p>
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>
                            <form method="POST" action="{{route('users.destroy', $user->id)}}" style="display: inline-block">
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
