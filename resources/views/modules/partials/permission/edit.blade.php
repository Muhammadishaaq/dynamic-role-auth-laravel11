@extends('../modules/layouts.main')
@section('contents')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                 <h1>Edit Permission</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    
    <div class="row mx-3">
        <div class="col-6">
        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Permission Name</label>
                <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </form>
        </div>
    </div>
@endsection
