<x-back-layouts title="Roles">
    <x-back.breadcrumb page="Roles Management" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="row">
                            <div class="col-4">
                                <div class="card" style="background-color: #241468">
                                    <h4 class="m-2">Dashboard</h4>
                                    <div class="card-body">
                                        @foreach ($permissionDashboard as $item)
                                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                                            '' }} disabled>
                                            <span class="badge  {{ in_array($item->id, $rolePermissions) ? 'bg-success' :
                                            'bg-warning' }} gap-2 m-1">{{ $item->name }}</span>
                                        </label>

                                        <br />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="background-color: #241468">
                                    <h4 class="m-2">Roles</h4>
                                    <div class="card-body">
                                        @foreach ($permissionRoles as $item)
                                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                                            '' }} disabled>
                                            <span class="badge  {{ in_array($item->id, $rolePermissions) ? 'bg-success' :
                                            'bg-warning' }} gap-2 m-1">{{ $item->name }}</span>
                                        </label>
                                        <br />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card" style="background-color: #241468">
                                    <h4 class="m-2">Users</h4>
                                    <div class="card-body">
                                        @foreach ($permissionUsers as $item)
                                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                                            '' }} disabled>
                                            <span class="badge  {{ in_array($item->id, $rolePermissions) ? 'bg-success' :
                                            'bg-warning' }} gap-2 m-1">{{ $item->name }}
                                            </span>
                                        </label>
                                        <br />
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <strong>Permissions:</strong>
                            @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            <span class="badge bg-light-primary gap-2">{{ $v->name }}</span>
                            @endforeach
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-back-layouts>