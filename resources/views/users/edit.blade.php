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
                <form action="{{route('users.update', $user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="userName">User Name</label>
                        <input type="text" class="form-control" name="name" id="userName" value="{{$user->name}}">
                    </div>
                    <label for="userRole">User Role</label>
                    <select id="userRole" class="form-select" name="role_id">
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" @if ($user->hasRole($role->name)) selected @endif>{{$role->name}}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
