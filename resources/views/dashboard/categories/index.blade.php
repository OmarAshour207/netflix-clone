@extends('layouts.dashboard.app')

@section('content')
    <div class="app-title">
        <div>
            <h2><i class="fa fa-list"></i> Categories</h2>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>
    </div>

    <div class="tile mb-4">
        <div class="row">
            <div class="col-12">
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="search" autofocus title="search" class="form-control" placeholder="Search...." value="{{ request()->search }}">
                            </div>
                        </div> <!-- End of col-4 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i> Search </button>
                                @if(auth()->user()->hasPermission('create_categories'))
                                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>  Add </a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>  Add </a>
                                @endif
                            </div>
                        </div> <!-- End of col-4 -->
                    </div> <!-- End of row -->
                </form> <!-- End of form -->
            </div> <!-- End of col-12 -->
        </div> <!-- End of row -->

        @if($categories->count() > 0)
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Name </th>
                            <th> Movies Count </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $index => $category)
                            <tr>
                                <td> {{ ++$index }} </td>
                                <td> {{ $category->name }} </td>
                                <td> {{ $category->movies_count }} </td>
                                <td>
                                    @if(auth()->user()->hasPermission('update_categories'))
                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-warning btn-sm" disabled="">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif

                                    @if(auth()->user()->hasPermission('delete_categories'))
                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('delete')

                                            <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> </button>
                                        </form>
                                    @else
                                        <button type="submit" class="btn btn-danger btn-sm delete" disabled><i class="fa fa-trash"></i> </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div><!-- End of row -->
        @else
            <h3 style="font-weight: 400">
                No Data records found
            </h3>
        @endif

    </div> <!-- End of tile -->

@endsection
