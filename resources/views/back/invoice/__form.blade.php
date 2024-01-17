<div class="row">
   <div class="card border border-primary">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 mt-3">
                <label for="invalid-state">Name Invoice</label>
                <input 
                type="text" 
                class="form-control mt-2 
                @error('name')
                is-invalid
                @enderror" 
                id="invalid-state" 
                placeholder="Enter Name" 
                name="name"
                value="{{ $invoice->name ?? old('name')}}" 
                required>
                @error('name')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
            </div>
        
        
            <div class="col-sm-6 mt-3">
                <label for="invalid-state">Attn</label>
                <input 
                type="text" 
                class="form-control mt-2 
                @error('attn')
                is-invalid
                @enderror" 
                id="invalid-state" 
                placeholder="Enter attn" 
                name="attn"
                value="{{ $invoice->attn ?? old('attn') }}" 
                required>
                @error('attn')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
            </div>
        
            <div class="col-sm-6 mt-3">
                <label for="invalid-state">Vessel</label>
                <input 
                type="text" 
                class="form-control mt-2 
                @error('vessel')
                is-invalid
                @enderror" 
                id="invalid-state" 
                placeholder="Enter Vessel" 
                name="vessel"
                value="{{ $invoice->vessel ?? old('vessel') }}" 
                required>
                @error('vessel')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
            </div>
        
        
            <div class="col-sm-6 mt-3">
                <label for="invalid-state">Voy</label>
                <input 
                type="text" 
                class="form-control mt-2 
                @error('voy')
                is-invalid
                @enderror" 
                id="invalid-state" 
                placeholder="Enter Voy" 
                name="voy"
                value="{{ $invoice->voy ?? old('voy') }}" 
                required>
                @error('voy')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
            </div>
        
            <div class="col-sm-12 mt-3">
                <label for="invalid-state">Address</label>
                <textarea rows="5" 
                type="text" 
                class="form-control mt-2 
                @error('address')
                is-invalid
                @enderror" 
                id="invalid-state" 
                placeholder="Enter Address" 
                name="address"
                required>{{ $invoice->address ?? old('address') }}</textarea rows="5">
                @error('address')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>
   </div>

    <div class="col-12 mt-5">
        <div class="card border border-primary">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
       
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
       
                <table class="table table-bordered" id="dynamicTable">  
                    <tr>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Rate</th> 
                        <th><button type="button" name="add" id="add" class="btn btn-success">Add More</button></th>  
                    </tr>
                @if ($invoice->id === null)
                {{-- START FORM CREATE --}}
                        {{-- START DATA FUNCTION old --}}
                            @if (old('addmore') ?? [])
                                @foreach (old('addmore') ?? [] as $key => $item)
                                    <tr>
                                        <td><textarea rows="5" name="addmore[{{ $key + 20 }}][description]" placeholder="Enter your Description" class="form-control">{{ $item['description'] }}</textarea></td>
                                        <td><input type="number" value="{{ $invoice->qty ?? $item['qty'] }}" name="addmore[{{ $key + 20 }}][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                                        <td><input type="text" value="{{ $invoice->unit ?? $item['unit']  }}" name="addmore[{{ $key + 20 }}][unit]" placeholder="Enter your Unit" class="form-control" /></td>  
                                        <td><input type="number" value="{{ $invoice->rate ?? $item['rate'] }}" name="addmore[{{ $key + 20 }}][rate]" placeholder="Enter your rate" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>
                                @endforeach
                            @else
                                    <tr>  
                                        <td><textarea rows="5" name="addmore[0][description]" placeholder="Enter your Description" class="form-control">{{ $invoice->description }}</textarea rows="5"></td>  
                                        <td><input type="number" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                                        <td><input type="text" name="addmore[0][unit]" placeholder="Enter your Unit" class="form-control" /></td>  
                                        <td><input type="number" name="addmore[0][rate]" placeholder="Enter your rate" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr> 
                                
                            @endif
                        {{-- END DATA FUNCTION old --}}
                    {{-- START FORM CREATE --}}
                    @elseif($invoice->id !== null)
                    {{-- START FORM EDIT --}}
                        {{-- Start data Loopingan old --}}
                            @if (old('addmore') ?? $itemInvoice )
                                @foreach (old('addmore') ?? $itemInvoice  as $key => $item)
                                    <tr>
                                        <td><textarea rows="5" name="addmore[{{ $key + 20 }}][description]" placeholder="Enter your Description" class="form-control">{{ $item['description'] }}</textarea></td>
                                        <td><input type="number" value="{{ $item['qty'] }}" name="addmore[{{ $key + 20 }}][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                                        <td><input type="text" value="{{ $item['unit']  }}" name="addmore[{{ $key + 20 }}][unit]" placeholder="Enter your Unit" class="form-control" /></td>  
                                        <td><input type="number" value="{{ $item['rate'] }}" name="addmore[{{ $key + 20 }}][rate]" placeholder="Enter your rate" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        {{-- End data Loopingan old --}}
                    {{-- END FORM EDIT --}}
                    @endif
                </table> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append(`<tr>  
                    <td><textarea rows="5"  name="addmore[`+i+`][description]" placeholder="Enter your Description" class="form-control">{{ $invoice->description ?? old('addmore.`+i+`.description') }}</textarea rows="5"></td>  
                    <td><input type="number" value="{{ $invoice->qty ?? old('addmore.`+i+`.qty') }}" name="addmore[`+i+`][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                    <td><input type="text" value="{{ $invoice->unit ?? old('addmore.`+i+`.unit') }}" name="addmore[`+i+`][unit]" placeholder="Enter your Unit" class="form-control" /></td>  
                    <td><input type="number" value="{{ $invoice->rate ?? old('addmore.`+i+`.rate') }}" name="addmore[`+i+`][rate]" placeholder="Enter your rate" class="form-control" /></td>
                    
                    <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>  
                </tr>`);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>