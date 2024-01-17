<div class="row">
    <div class="col-6">
        <div class="card border border-primary">
            <div class="card-body">
                <label class="text-decoration-underline fw-bold">Shipper</label>

                <div class="col-sm-12 mt-3">
                    <label for="">Category Letter</label>
                    <select class="form-select" name="category_letter_id" aria-label="Default select example">
                        <option  disabled>Select...</option>
                        @foreach ($categoryLetter as $item)
                        <option {{ $item->id === $letter->id ? 'selected' : '' }} value="{{ $item->id }}">{{ strtoupper($item->name) }}</option>
                        @endforeach
                      </select>
                </div>

                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Shipper Name</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('shipper_name')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter Shipper Name" 
                    name="shipper_name"
                    value="{{ $letter->shipper_name ?? old('shipper_name')}}"
                    required>
                    @error('shipper_name')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Shipper Address</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('shipper_address')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter Shipper Address" 
                    name="shipper_address"
                    value="{{ $letter->shipper_address ?? old('shipper_address') }}"
                    required>
                    @error('shipper_address')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>

            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card border border-primary">
            <div class="card-body">
                <label class="text-decoration-underline fw-bold">Consignee</label>
                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Consignee Name</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('consignee_name')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter Shipper Name" 
                    name="consignee_name"
                    value="{{ $letter->consignee_name ?? old('consignee_name')}}"
                    required>
                    @error('consignee_name')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Consignee Address</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('consignee_address')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter consignee Address" 
                    name="consignee_address"
                    value="{{ $letter->consignee_address ?? old('consignee_address') }}"
                    required>
                    @error('consignee_address')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Consignee ATTN</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('consignee_attn')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter consignee Address" 
                    name="consignee_attn"
                    value="{{ $letter->consignee_attn ?? old('consignee_attn') }}"
                    required>
                    @error('consignee_attn')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Consignee Phone</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('consignee_phone')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter consignee Address" 
                    name="consignee_phone"
                    value="{{ $letter->consignee_phone ?? old('consignee_phone') }}"
                    required>
                    @error('consignee_phone')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>


                <div class="col-sm-12 mt-3">
                    <label for="invalid-state">Shipment</label>
                    <input 
                    type="text" 
                    class="form-control mt-2 
                    @error('shipment')
                    is-invalid
                    @enderror" 
                    id="invalid-state" 
                    placeholder="Enter consignee Address" 
                    name="shipment"
                    value="{{ $letter->shipment ?? old('shipment') }}"
                    required>
                    @error('shipment')
                    <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                       {{$message}}
                    </div>
                    @enderror
                </div>

            </div> 
        </div>
    </div>


    <div class="col-12">
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
                    <th>Dimension</th>
                    <th><button type="button" name="add" id="add" class="btn btn-success">Add More</button></th>  
                    
                </tr>
              
                @if ($letter->id === null)
                    {{-- START FORM CREATE --}}
                        {{-- START FORM FUNCTION OLD --}}
                            @if (old('addmore') ?? [])
                                @foreach (old('addmore') ?? [] as $key => $item)
                                    <tr>  
                                        <td><textarea name="addmore[{{ $key + 20 }}][description]" placeholder="Enter your Description" class="form-control">{{ $item['description'] }}</textarea></td>  
                                        <td><input type="text" value="{{ $item['qty'] }}" name="addmore[{{ $key + 20 }}][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                                        <td><input type="text" value="{{ $item['dimension'] }}" name="addmore[{{ $key + 20 }}][dimension]" placeholder="Enter your Dimension" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>
                                @endforeach  
                            @else
                                    <tr>  
                                        <td><textarea name="addmore[0][description]" placeholder="Enter your Description" class="form-control">{{ $letter->description }}</textarea></td>  
                                        <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                                        <td><input type="text" name="addmore[0][dimension]" placeholder="Enter your Dimension" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>  
                            @endif 
                        {{-- END FORM FUNCTION OLD --}}
                     {{-- END FORM CREATE --}}
                @elseif($letter->id !== null)
                {{-- START FORM EDIT --}}
                    {{-- START FORM FUNCTION OLD --}}
                        @if (old('addmore') ?? $itemLetter)
                            @foreach (old('addmore') ?? $itemLetter as $key => $item)
                                <tr>  
                                    <td><textarea name="addmore[{{ $key + 20 }}][description]" placeholder="Enter your Description" class="form-control">{{ $item['description'] }}</textarea></td>  
                                    <td><input type="text" value="{{ $item['qty'] }}" name="addmore[{{ $key + 20 }}][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                                    <td><input type="text" value="{{ $item['dimension'] }}" name="addmore[{{ $key + 20 }}][dimension]" placeholder="Enter your Dimension" class="form-control" /></td>
                                    <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                </tr>
                            @endforeach  
                        @endif 
                    {{-- END FORM FUNCTION OLD --}}   
                {{-- END FORM EDIT --}}
                @endif
               
            </table> 
        
            </div>
        </div>
    </div>

    <div class="">
        <div class="col-sm-4 mt-3">
            <div class="input-group mb-3">
                <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">Total Gross Weight</span>
                <input 
                type="text" 
                class="form-control border border-primary
                @error('total_gross_weight')
                is-invalid
                @enderror" 
                aria-label="Sizing example input" 
                aria-describedby="inputGroup-sizing-default"
                id="invalid-state" 
                placeholder="Enter Total Gross Weight"
                name="total_gross_weight"
                value="{{ $letter->total_gross_weight ?? old('total_gross_weight') }}"
                required>
                @error('total_gross_weight')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
              </div>
        </div>
        <div class="col-sm-4 mt-3">
            <div class="input-group mb-3">
                <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">Total Package</span>
                <input 
                type="text" 
                class="form-control border border-primary
                @error('total_package')
                is-invalid
                @enderror" 
                aria-label="Sizing example input" 
                aria-describedby="inputGroup-sizing-default"
                id="invalid-state" 
                placeholder="Enter Total Gross Weight"
                name="total_package"
                value="{{ $letter->total_package ?? old('total_package') }}"
                required>
                @error('total_package')
                <div class="invalid-feedback">
                    <i class="bx bx-radio-circle"></i>
                   {{$message}}
                </div>
                @enderror
              </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append(`<tr>  
                    <td><textarea type="text" name="addmore[`+i+`][description]" placeholder="Enter your Description" class="form-control"></textarea></td>  
                    <td><input type="text" name="addmore[`+i+`][qty]" placeholder="Enter your Qty" class="form-control" /></td>  
                    <td><input type="text" name="addmore[`+i+`][dimension]" placeholder="Enter your Dimension" class="form-control" /></td>
                    <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>  
                </tr>`);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>