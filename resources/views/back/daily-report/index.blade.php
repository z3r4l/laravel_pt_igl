<x-back-layouts title="Daily Reports">
    <x-back.breadcrumb page="Daily Reports" />
    <div class="row">
        <div class="card">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
             @endif
            <div class="card-header">
                           {{-- START FILTER --}}
                           <div class="row input-daterange">
                            <div class="col-md-4">
                                <a class="btn btn-success" href="{{ route('daily-report.create') }}"> Create New Daily Report</a>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                            </div>
                            <div class="col-md-2">
                                <button type="button" name="filter" id="filter" class="btn btn-primary me-2">Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Refresh</button>
                            </div>
                        </div>
                   {{-- END FILTER --}}
                <div class="">
                   
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-daily-report" >
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">JENIS DOCUMENT PPFTZ</th>
                                <th class="text-center">NO PENDAFTARAN</th>
                                <th class="text-center">TANGGAL DOKUMEN</th>
                                <th class="text-center">SHIPPER</th>
                                <th class="text-center">CONSIGNEE</th>
                                <th class="text-center">NAME VESSEL</th>
                                <th class="text-center">VOY</th>
                                <th class="text-center">NO FAKTUR PAJAK</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">NO BL</th>
                                <th class="text-center">KETERANGAN</th>
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
  <script>
    $(document).ready(function(){
        $('.input-daterange').datepicker({
            todayBtn:'linked',
            format:'yyyy-mm-dd',
            autoclose:true
        });

        load_data();

        function load_data(from_date = '', to_date = ''){
            $('.table-daily-report').DataTable({
                processing: true,
                serverSide: true,
                createdRow: function (row, data, dataIndex)
                {
                $(row).addClass(`Row${data.id}`);
                },
                ajax: {
                    url:"{{ route('daily-report.index') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'type_document', name: 'type_document'},
              {data: 'no_pendaftaran', name: 'no_pendaftaran'},
              {data: 'date_document', name: 'date_document'},
              {data: 'shipper', name: 'shipper'},
              {data: 'consignee', name: 'consignee'},
              {data: 'name_vessel', name: 'name_vessel'},
              {data: 'voy', name: 'voy'},
              {data: 'no_tax', name: 'no_tax'},
              {data: 'date_faktur', name: 'date_faktur'},
              {data: 'no_bl', name: 'no_bl'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action',
                orderable: true, 
                searchable: true,
                className: 'not-export-col'
            },
          ],
          dom: "Blfrtip",
                buttons: [
                    {
                        text: 'excel',
                        extend: 'excelHtml5',
                        exportOptions: {
                            // columns: ':visible:not(.not-export-col)'
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11 ]
                        }
                    },
                    {
                        text: 'pdf',
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11 ]
                        }
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11 ]
                        }
                    },
                    
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }],

            });
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if(from_date != '' &&  to_date != ''){
                $('.table-daily-report').DataTable().destroy();
                load_data(from_date, to_date);
            } else{
                alert('Both Date is required');
            }

        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('.table-daily-report').DataTable().destroy();
            load_data();
        });
    });
</script>
{{-- END TABLE user --}}

</x-back-layouts>