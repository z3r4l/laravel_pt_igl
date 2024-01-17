<x-back-layouts title="Roles">
    <x-back.breadcrumb page="Roles Management" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <!-- Check if the user can create a role -->
                    @if (Auth::user()->can('role-create'))
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                </div>
              <div class="table-responsive">
                <table class="table table-bordered" id="tableRoles">
                    <thead>
                        <th class="text-center">No</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody class="text-center"></tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
    
      {{-- START TABLE user --}}
  <script type="text/javascript">
    $(function () {
      var table = $('#tableRoles').DataTable({
          processing: true,
          serverSide: true,
          createdRow: function (row, data, dataIndex)
            {
              $(row).addClass(`Row${data.id}`);
            },
          ajax: "{{ route('roles.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'name', name: 'name'},
              {data: 'action', name: 'action',
                orderable: true, 
                searchable: true},
          ]
      });
      
    });
  </script>
</x-back-layouts>