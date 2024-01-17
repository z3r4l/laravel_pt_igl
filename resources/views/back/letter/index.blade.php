<x-back-layouts title="Letter">
    <x-back.breadcrumb page="Letter" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a class="btn btn-success" href="{{ route('letter.create') }}"> Create New Letter</a>
                </div>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
               
            
                <div class="table-responsive">
                    <table class="table-letter" >
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Shipper name</th>
                                <th class="text-center">Shipper Address</th>
                                <th class="text-center">Consignee Name</th>
                                <th class="text-center">Consignee Address</th>
                                <th class="text-center">Shipment</th>
                                <th class="text-center">Total Gross Weight</th>
                                <th class="text-center">Total Package</th>
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

      var table = $('.table-letter').DataTable({
          processing: true,
          serverSide: true,
          createdRow: function (row, data, dataIndex)
            {
              $(row).addClass(`Row${data.id}`);
            },
          ajax: "{{ route('letter.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'shipper_name', name: 'shipper_name'},
              {data: 'shipper_address', name: 'shipper_address'},
              {data: 'consignee_name', name: 'consignee_name'},
              {data: 'consignee_address', name: 'consignee_address'},
              {data: 'shipment', name: 'shipment'},
              {data: 'total_gross_weight', name: 'total_gross_weight'},
              {data: 'total_package', name: 'total_package'},
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
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            stripHtml: false,
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7]
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