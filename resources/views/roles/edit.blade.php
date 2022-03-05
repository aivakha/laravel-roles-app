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
                <form action="{{route('roles.update', $role->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="articleTitle">Title</label>
                        <input type="text" class="form-control" name="title" id="articleTitle" value="{{$role->name}}">
                    </div>
                    @foreach($permissions as $permission)
                        <div class="form-group form-check">
                            <input class="form-check-input"
                                   value="{{$permission->id}}"
                                   type="checkbox"
                                   name="permissions[]"
                                   id="prms-{{$permission->id}}"
                                   @if ($role->hasPermissionTo($permission->name)) checked @endif >
                            <label class="form-check-label" for="prms-{{$permission->id}}">{{$permission->name}}</label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
