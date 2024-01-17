<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" name="name" value="{{ $role->name }}" placeholder="Name"
                class="form-control">
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
                            '' }}>
                            {{ $item->name }}</label>
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
                            '' }}>
                            {{ $item->name }}</label>
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
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #241468">
                    <h4 class="m-2">Company</h4>
                    <div class="card-body">
                        @foreach ($permissionCompanies as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #241468">
                    <h4 class="m-2">Daily Report</h4>
                    <div class="card-body">
                        @foreach ($permissionDailyReports as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #241468">
                    <h4 class="m-2">Letters</h4>
                    <div class="card-body">
                        @foreach ($permissionLetters as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #241468">
                    <h4 class="m-2">Category Letters</h4>
                    <div class="card-body">
                        @foreach ($permissionCategoryLetters as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="background-color: #241468">
                    <h4 class="m-2">Invoices</h4>
                    <div class="card-body">
                        @foreach ($permissionInvoices as $item)
                        <label><input type="checkbox" name="permission[]" value="{{ $item->id }}"
                                class="name" {{ in_array($item->id, $rolePermissions) ? 'checked' :
                            '' }}>
                            {{ $item->name }}</label>
                        <br />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary" id="buttonSubmit"onclick="disableButton();">Submit</button>
    </div>
</div>