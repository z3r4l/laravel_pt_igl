<x-back-layouts title="Category Letter">
    <x-back.breadcrumb page="Category Letter" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('category-letter.create') }}"> Create New Category Letter</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
               
                <div class="table-responsive">
                    <table class="table-category-letter" >
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Code Letter</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  {{-- START TABLE user --}}
  <script type="text/javascript">
    $(function () {
      var table = $('.table-category-letter').DataTable({
          processing: true,
          serverSide: true,
          createdRow: function (row, data, dataIndex)
            {
              $(row).addClass(`Row${data.id}`);
            },
          ajax: "{{ route('category-letter.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'name', name: 'name'},
              {data: 'code_letter', name: 'code_letter'},
              {data: 'action', name: 'action',
                orderable: true, 
                searchable: true},
          ]
      });
      
    
    });
  </script>
{{-- END TABLE user --}}

</x-back-layouts>