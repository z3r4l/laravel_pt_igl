<x-back-layouts title="Company">
    <x-back.breadcrumb page="Company" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('company.create') }}"> Create New Company</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
               
                <div class="table-responsive">
                    <table class="table-company" >
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">WEBSITE</th>
                                <th class="text-center">ADDRESS</th>
                                <th class="text-center">CUSTOMERS</th>
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
      var table = $('.table-company').DataTable({
          processing: true,
          serverSide: true,
          createdRow: function (row, data, dataIndex)
            {
              $(row).addClass(`Row${data.id}`);
            },
          ajax: "{{ route('company.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'name', name: 'name'},
              {data: 'website', name: 'website'},
              {data: 'address', name: 'address'},
              {
                data: 'customers', 
                name: 'customers',
                render: function (data, type, full, meta) {
                    return data.map(function (item, index) {
                        // return ' ' + ('*') + '. ' + item.phone;
                        return 'CUSTOMER' + (index + 1) + '<br> Name Customer :  ' + item.name + '<br> Email : ' + item.email + '<br> Phone : ' + item.phone
                    }).join('<br>');
                }
            },
              {data: 'action', name: 'action',
                orderable: true, 
                searchable: true},
          ],
          dom: "Blfrtip",
                buttons: [
                    {
                        text: 'excel',
                        extend: 'excelHtml5',
                        exportOptions: {
                            // columns: ':visible:not(.not-export-col)'
                            columns: [ 0, 1, 2, 3, 4]
                        }
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            stripHtml: false,
                            columns: [ 0, 1, 2, 3, 4]
                        }
                    },
                    
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],
      });
      
    
    });
  </script>
{{-- END TABLE user --}}

</x-back-layouts>