<select name="permission_id" id="permission_id" class="form-control">
    <option value="">---</option>
@foreach ($permissions as $permission)
    <option value="{{ $permission->id }}" {{ $permission_id != $permission->id ?: "selected='selected'"}}>{{ $permission->name }}</option>
@endforeach
</select>