<x-back-layouts title="Invoice">
    <x-back.breadcrumb page="Invoice" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                {{-- START FILTER --}}
                <div class="row input-daterange">
                    <div class="col-md-4">
                        <a class="btn btn-success" href="{{ route('invoice.create') }}"> Create New Invoice</a>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                            readonly />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                            readonly />
                    </div>
                    <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn btn-primary me-2">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-secondary">Refresh</button>
                    </div>
                </div>
                {{-- END FILTER --}}
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table-invoice">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NAME</th>
                                <th class="text-center">ADDRESS</th>
                                <th class="text-center">ATTN</th>
                                <th class="text-center">VESSEL</th>
                                <th class="text-center">VOY</th>
                                <th class="text-center">CREATED</th>
                                <th class="text-center">DESCRIPTION</th>
                                <th class="text-center">QTY</th>
                                <th class="text-center">RATE</th>
                                <th class="text-center">TOTAL VALUE</th>
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
        function indexToAlphabet(index) {
            return String.fromCharCode(65 + index); // 65 adalah kode ASCII untuk huruf 'A'
        }
        function load_data(from_date = '', to_date = ''){
            $('.table-invoice').DataTable({
                processing: true,
                serverSide: true,
                createdRow: function (row, data, dataIndex)
                {
                $(row).addClass(`Row${data.id}`);
                },
                ajax: {
                    url:"{{ route('invoice.index') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
              {data: 'name', name: 'name'},
              {data: 'address', name: 'address', visible:false},
              {data: 'attn', name: 'attn', visible:false},
              {data: 'vessel', name: 'vessel', visible:false},
              {data: 'voy', name: 'voy', visible:false},
              {data: 'created_at', name: 'created_at'},
              {
                "width": "20%",
                data: 'description',
                name: 'description',
                render: function (data, type, full, meta) {
                    return data.map(function (item, index) {
                        var alphabetIndex = indexToAlphabet(index);
                        return ' ' + alphabetIndex + '. '  + '. ' + item.description;
                    }).join('<br>');
                }
              },
              {
                data: 'item_invoice', 
                name: 'item_invoice',
                render: function (data, type, full, meta) {
                    return data.map(function(item, index) {
                        var alphabetIndex = indexToAlphabet(index);
                        return ' ' + alphabetIndex + '. '  + '. ' + item.qty;
                    }).join('<br>');
                },
              },
              {
                data: 'item_invoice', 
                name: 'item_invoice',
                render: function (data, type, full, meta) {
                    return data.map(function(item, index) {
                        var alphabetIndex = indexToAlphabet(index);
                        return ' ' + alphabetIndex + '. '  + item.rate.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });;
                    }).join('<br>');
                },
              },
              {
                data: 'item_invoice', 
                name: 'item_invoice',
                render: function (data, type, full, meta) {
                    return data.map(function(item,index) {
                        var alphabetIndex = indexToAlphabet(index);
                        return ' ' + alphabetIndex + '. ' + '. ' +item.total_value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });;
                    }).join('<br>');
                },
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
                            stripNewlines: false,
                            columns: [ 0, 1, 7, 8, 9, 10 ]
                        }
                    },
                    {
                        text: 'print',
                        extend: 'print',
                        exportOptions: {
                            stripHtml: false,
                            columns: [ 0, 1, 7, 8, 9, 10 ],
                        },
                        customize: function(win) {
                    // Tidak melakukan penghapusan HTML, biarkan HTML tetap dalam PDF
                    // Contoh: Menambahkan judul ke PDF
                    $(win.document.body).find('table').addClass('display').css('font-size', '12px');

                    // Menetapkan lebar kolom ke-8 saat mencetak
                    $(win.document.body).find('table tr:first-child th:nth-child(3)').css('width', '30%');
                    $(win.document.body).find('table tr:nth-child(n+2) td:nth-child(3)').css('width', '30%');
                }
                    },
                    
                ],
                columnDefs: [{
                    targets: 8, // Indeks kolom ke-8
                    width: '20%'
                }],
                
            });
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if(from_date != '' &&  to_date != ''){
                $('.table-invoice').DataTable().destroy();
                load_data(from_date, to_date);
            } else{
                alert('Both Date is required');
            }

        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('.table-invoice').DataTable().destroy();
            load_data();
        });
    });
    </script>
    {{-- END TABLE user --}}

</x-back-layouts>