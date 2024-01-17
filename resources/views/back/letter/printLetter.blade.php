<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
   </head>
   <body>
      <nav class="navbar navbar-expand-lg" style="background-color: #eaeaea">
         <div class="container">
            <a class="navbar-brand" href="#">LETTER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
               <div class="navbar-nav ms-auto">
                  <button class="btn btn-small btn-primary me-2" onclick="printDOM()" id="btn-print"><i class="mdi mdi-printer me-1"></i>Print</button>
                 @include('back.partial.buttonBack')
               </div>
            </div>
         </div>
      </nav>
      <div id="printLetter">
         <!--START KOP SURAT -->
         <header class="mt-3">
            <div class="row">
               <div class="col-lg-2 col-2 d-flex justify-content-center align-items-center"><img class="" src="{{ asset('back/assets/img/LOGO.jpg') }}" height="100" width="100" alt="" /></div>
               <div class="col-lg-10 col-10">
                  <div class="text-center">
                     <span class="fw-bold mb-0" style="font-size: 40px">PT. INTER GLOBAL LOGISTIC</span>
                     <p class="mb-0 fw-bold" style="font-size: 16px">Freight Forwading, Customs Clearance & Shipping Agency</p>
                     <p class="mb-0 fw-bold" style="font-size: 16px">Komp. Ruko Mega Legenda Extention blok G2 No.20, Baloi Permai, - Batam</p>
                     <p class="mb-0 fw-bold" style="font-size: 16px">Telp. (0778) 4171284, Email : loginterglobal@gmail.com</p>
                  </div>
               </div>
               <hr class="border border-dark border-3 opacity-75" />
            </div>
         </header>
         <!--END KOP SURAT -->

         <!-- START NO SURAT -->
         <div class="no-surat text-center">
            <p class="text-decoration-underline fw-bolder mb-0" style="font-size: 18px">{{ strtoupper($letter->categoryLetter->name) }}</p>
            <p class="fw-bolder mb-0" style="font-size: 16px">NO : {{ $letter->no_letter }}/{{ $letter->categoryLetter->code_letter }}/IGL/{{ $angkaRomawi }}/{{ $tahun }}</p>
         </div>
         <!-- END NO SURAT -->

         <!-- START INFORMASI -->
         <div class="">
            <div class="row">
               <div class="col-4">
                  <p class="text-decoration-underline fw-bold mb-0" style="font-size: 16px">SHIPPER</p>
                  <p class="fw-bold mb-0" style="font-size: 14px">{{ $letter->shipper_name }}</p>
                  <p class="mb-0" style="font-size: 14px">{{ $letter->shipper_address }}</p>
               </div>
               <div class="col-4"></div>
               <div class="col-4">
                  <p class="text-decoration-underline fw-bold mb-0" style="font-size: 16px">CONSIGNEE</p>
                  <p class="fw-bold mb-0" style="font-size: 14px">{{ $letter->consignee_name }}</p>
                  <p class="mb-0" style="font-size: 14px">{{ $letter->consignee_address }}</p>
                  <table>
                     <tr>
                        <td><p class="mb-0" style="font-size: 14px">Attn</p></td>
                        <td><p class="mb-0" style="font-size: 14px">:</p></td>
                        <td>
                           <p class="mb-0" style="font-size: 14px"><span> {{ $letter->consignee_attn }}</span></p>
                        </td>
                     </tr>
                     <tr>
                        <td><p class="mb-0" style="font-size: 14px">Phone</p></td>
                        <td><p class="mb-0" style="font-size: 14px">:</p></td>
                        <td>
                           <p class="mb-0" style="font-size: 14px"><span> {{ $letter->consignee_phone }}</span></p>
                        </td>
                     </tr>
                     <tr>
                        <td><p class="mb-0 fw-bold mt-3" style="font-size: 12px">Shipment</p></td>
                        <td><p class="mb-0 fw-bold mt-3" style="font-size: 12px">:</p></td>
                        <td>
                           <p class="mb-0 fw-bold mt-3" style="font-size: 12px"><span> {{ $letter->shipment }}</span></p>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
         <!-- END INFORMASI -->

         <!-- START TABLE BARANG -->
         <div class="mt-3">
            <div class="row">
               <div class="d-flex justify-content-center">
                  <table class="table table-bordered m-1">
                     <tr class="text-center">
                        <th style="font-size: 12px; width: 10px">NO</th>
                        <th style="font-size: 12px">DESCRIPTION</th>
                        <th style="font-size: 12px">QTY</th>
                        <th style="font-size: 12px">DIMENSION</th>
                     </tr>
                     @foreach ($itemLetter as $item)
                     <tr class="text-start">
                        <td style="font-size: 12px">{{ $loop->iteration }}</td>
                        <td style="font-size: 12px">{!! nl2br($item->description) !!}</td>

                        <td class="text-center" style="font-size: 12px">{{ $item->qty }}</td>
                        <td style="font-size: 12px">{{ $item->dimension }}</td>
                     </tr>
                     @endforeach
                    
                     <tr class="text-center border border-bottom-0">
                        <td class="opacity-0">-</td>
                        <td class="opacity-0">-</td>
                        <td class="opacity-0">-</td>
                        <td class="opacity-0">-</td>
                     </tr>
                    
                     <tr class="border border-top-0">
                        <td></td>
                        <td>
                           <p class="mb-0 fw-bolder" style="font-size: 12px">Total Gros Weight : {{ $letter->total_gross_weight }}</p>
                           <p class="mb-0 fw-bolder" style="font-size: 12px">Total Package : {{  $letter->total_package }}</p>
                        </td>
                        <td></td>
                        <td></td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
         <!-- END TABLE BARANG -->

         <!-- START TANDA TANGAN -->
         <div>
            <div class="row">
               <div class="col-4">
                  <table>
                     <tr>
                        <p class="mb-0 fw-bold" style="font-size: 12px">Batam, {{ $formattedDate }}</p>
                        <p class="mb-0 fw-bold" style="font-size: 12px">PREPARE BY</p>
                     </tr>
                     <tr>
                        <p class="opacity-0">-</p>
                     </tr>
                     <tr>
                        <p class="opacity-0">-</p>
                     </tr>
                     <tr>
                        <p class="opacity-0">-</p>
                     </tr>
                     <tr>
                        <p class="mb-0 fw-bold" style="font-size: 12px">NORMAN</p>
                     </tr>
                  </table>
               </div>
               <div class="col-4"></div>
               <div class="col-4">
                  <table>
                     <tr>
                        <p class="mb-0 fw-bold" style="font-size: 12px">RECEIVED IN GOODS ORDER</p>
                        <p></p>
                     </tr>
                     <tr>
                        <p class="opacity-0">-</p>
                     </tr>
                     <tr>
                        <p class="opacity-0">-</p>
                     </tr>
                     <tr>
                        <p class="opacity-0">-</p>
                     </tr>
                     <tr>
                        <hr class="mb-0" width="200" />
                        <p class="mb-0 fw-bold" style="font-size: 12px">SIGNED W/STAMP</p>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
         <!-- END TANDA TANGAN -->
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script>
         function printDOM() {
            var printContents = document.getElementById('printLetter').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
         }
      </script>
   </body>
</html>
