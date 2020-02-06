@extends('layouts.dashboard.app')

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-dashboard"></i> Roles</h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role - <span style="font-weight: bold"> {{ $role->name }} </span></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <form action="{{ route('dashboard.roles.update', $role->id) }}" method="post">
                    @csrf
                    @method('put')

                    @include('dashboard.partials._errors')

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
                    </div>

                    <div class="form-group">
                        <h4 style="font-weight: 400"> Permissions </h4>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 10%">#</th>
                                <th style="width: 20%">Model</th>
                                <th>Permissions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $models = ['categories', 'users'];
                            ?>
                            @foreach($models as $index => $model)
                                <tr>
                                    <td> {{ $index+1 }} </td>
                                    <td> {{ $model }} </td>
                                    <td>
                                        <?php
                                            $permission_map = ['create', 'read', 'update', 'delete'];
                                        ?>
                                        @if($model == 'settings')
                                            @php
                                                $permission_map = ['create', 'read'];
                                            @endphp
                                        @endif
                                        <select name="permissions[]" class="form-control select2" multiple>
                                            @foreach($permission_map as $permission)
                                                <option
                                                    value="{{ $permission . '_' . $model }}"
                                                    {{ $role->hasPermission($permission . '_' . $model) ? 'selected' : '' }}
                                                > {{ $permission }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                    </div>

                </form>
            </div> <!-- end of tile -->
        </div>
    </div>
@endsection
