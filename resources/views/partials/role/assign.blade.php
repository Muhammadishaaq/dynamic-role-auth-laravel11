@extends('../layouts.main')
@section('contents')
<div class="container">
    <h1>Assign Permissions to Role: {{ $role->name }}</h1>

    <form action="{{ route('roles.assignPermission', $role->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="permissions">Permissions</label>
            <select name="permissions[]" id="permissions" class="form-control" multiple>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}" 
                        {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-success">Assign Permissions</button>
        </div>
    </form>
</div>
@endsection
