<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #eaeaea;">
        <div class="container">
            <a class="navbar-brand" href="#">INVOICE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <button class="btn btn-small btn-primary me-2" onclick="printDOM()" id="btn-print">
                        <i class="mdi mdi-printer me-1"></i>Print
                    </button>
                  @include('back.partial.buttonBack')
                </div>
            </div>
        </div>
    </nav>
    <div id="invoice">
        <!-- START KOP INVOICE -->
        <header>
            <div class="row">
                <div class="col-5"><img class="" src="{{ asset('back/assets/img/LOGO.jpg') }}" height="100" width="100" alt="" /></div>
                <div class="col-7 d-flex align-items-center">
                    <p class="fw-bolder" style="font-size: 24px;">INVOICE</p>
                </div>
            </div>
        </header>
        <!-- END KOP INVOICE -->

        <!-- START INFORMATION -->
        <div class="mt-2">
            <div class="row">
                <div class="col-4">
                    <p class="fw-bold mb-0">PT Inter Global Logistic</p>
                    <p class="mb-0" style="font-size: 14px">Komp. Ruko Mega Legenda Extention blok G2 No.20, Baloi
                        Permai,
                        Kota Batam Kepulauan Riau</p>
                    <p class="mb-0" style="font-size: 14px">Telp. (0778) 4171284</p>
                    <p class="mb-0" style="font-size: 14px">loginterglobal@gmail.com</p>
                </div>
                <div class="col-4">
                    <p class="mb-0" style="font-size: 14px">Bill to :</p>
                    <p class="fw-bold mb-0" style="font-size: 14px">{{ $invoice->name }}</p>
                    <p class="mb-0" style="font-size: 14px">{{ $invoice->address }}</p>
                    <p class="mb-0" style="font-size: 14px">Attn : {{ $invoice->attn }}</p>
                </div>
                <div class="col-4">
                    <table>
                        <tr>
                            <td style="font-size: 14px">Invoice No</td>
                            <td style="font-size: 14px">:</td>
                            <td style="font-size: 14px">{{ $invoice->no_invoice }}/INV/{{ $month }}/{{ $year }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px">Date</td>
                            <td style="font-size: 14px">:</td>
                            <td style="font-size: 14px">{{ $date }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px">Vessel</td>
                            <td style="font-size: 14px">:</td>
                            <td style="font-size: 14px">{{ $invoice->vessel }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px">Voy</td>
                            <td style="font-size: 14px">:</td>
                            <td style="font-size: 14px">{{ $invoice->voy }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- END INFORMATION -->

        <!-- START TABLE BARANG -->
        <div class="mt-3">
            <div class="row">
                <P class="mb-0" style="font-size: 14px">Used Currency(IDR)</P>
                <div>
                    <table class="table">
                        <thead class="table-success">
                            <tr>
                                <th style="font-size: 14px">Task</th>
                                <th style="font-size: 14px">Description</th>
                                <th style="font-size: 14px">Qty</th>
                                <th style="font-size: 14px">Rate</th>
                                <th style="font-size: 14px">Total Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemInvoice as $item)
                            <tr>
                                <td style="font-size: 14px">{{ $loop->iteration }}</td>
                                <td style="font-size: 14px">{!! nl2br($item->description) !!}</td>
                                <td style="font-size: 14px">{{ $item->qty }} {{ $item->unit }}</td>
                                <td style="font-size: 14px">Rp {{ number_format($item->rate) }}</td>
                                <td style="font-size: 14px">Rp.{{ number_format($item->total_value) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-success">
                            <td class="p-0"><p class="opacity-0" style="font-size: 14px">-</p></td>
                            <td class="p-0"><p class="opacity-0" style="font-size: 14px">-</p></td>
                            <td class="p-0"><p class="opacity-0" style="font-size: 14px">-</p></td>
                            <td class="p-0 fw-bold" style="font-size: 14px">Amount Due</td>
                            <td class="p-0 fw-bold" style="font-size: 14px">Rp.{{ number_format($totalValue) }}</td>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- END TABLE BARANG -->

        <!-- START TERMS -->
        <div>
            <p class="mb-0" style="font-size: 14px">Terms</p>
            <p class="mb-0" style="font-size: 14px">- All rate is in IDR.</p>
            <p class="mb-0" style="font-size: 14px">- Payment should be made by cash or TT.</p>
            <p class="mb-0" style="font-size: 14px">- Rate above exclude taxes</p>
        </div>
        <!-- END TERMS -->

        <!-- START TANDA TANGAN -->
        <div class="mt-2">
            <p class="fw-bold mb-0" style="font-size: 14px">PT Bank Syariah Indonesia (eks BSM)</p>
            <p style="font-size: 14px">Acc Name : PT Inter Global Logistic <br> 7.108.975.711</p>
        </div>

        <div>
            <table>
                <thead>
                    <tr>
                        <td>
                            <p>Batam, January 08th,2024</p>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="opacity-0">-</td>
                    </tr>
                    <tr>
                        <td class="opacity-0">-</td>
                    </tr>
                    <tr>
                        <td class="opacity-0">-</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <p class="fw-bold text-decoration-underline">Siska</p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- END TANDA TANGAN -->

        <!-- START FOOTER INVOICE -->
        <footer class="mt-4">
            <div>
                <div class="row">
                    <div class="text-center">
                        <p class="fw-bold mb-0" style="font-size: 18px">PT. Inter Global Logistic</p>
                        <p class="mb-0" style="font-size: 18px">Komp. Ruko Mega Legenda Extention blok G2 No.20, Baloi
                            Permai, - Batam</p>
                        <p class="mb-0" style="font-size: 16px">Telp. (0778) 4171284, Email : loginterglobal@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END FOOTER INVOICE -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function printDOM() {
            var printContents = document.getElementById('invoice').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>