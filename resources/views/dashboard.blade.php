<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
                <h3>Current user role: <b>{{ Auth::user()->roles->pluck('name')[0] }}</b></h3>
            </div>
        </div>
    </div>

</x-app-layout>
