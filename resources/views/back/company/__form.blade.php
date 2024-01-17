<div class="row">
    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Name Company</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('name_company')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Enter Name company" 
        name="name_company"
        value="{{ $company->name ?? old('name_company') }}" 
        required>
        @error('name_company')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>


    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Website Company</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('website')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Enter Name company" 
        name="website"
        value="{{ $company->website ?? old('website')}}" 
        required>
        @error('website')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>


    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Address Company</label>
        <textarea 
        type="text" 
        class="form-control mt-2 
        @error('address')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Enter Name company" 
        name="address"
        required>{{ $company->address ?? old('address') }}</textarea>
        @error('address')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Description</label>
        <textarea 
        type="text" 
        class="form-control mt-2 
        @error('description')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Enter Name company" 
        name="description"
        required>{{ $company->description ?? old('description') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th><button type="button" name="add" id="add" class="btn btn-success">Add More</button></th>  
                    
                </tr>
              
                @if ($company->id === null)
                    {{-- START FORM CREATE --}}
                        {{-- START FORM FUNCTION OLD --}}
                            @if (old('addmore') ?? [])
                                @foreach (old('addmore') ?? [] as $key => $item)
                                    <tr>  
                                        <td><input type="text" value="{{ $item['name_customer'] }}" name="addmore[{{ $key + 20 }}][name_customer]" placeholder="Enter your name_customer" class="form-control"></td>  
                                        <td><input type="text" value="{{ $item['email'] }}" name="addmore[{{ $key + 20 }}][email]" placeholder="Enter your email" class="form-control" /></td>  
                                        <td><input type="text" value="{{ $item['phone'] }}" name="addmore[{{ $key + 20 }}][phone]" placeholder="Enter your phone" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>
                                @endforeach  
                            @else
                                    <tr>  
                                        <td><input type="text" name="addmore[0][name_customer]" placeholder="Enter your name_customer" class="form-control"></td>  
                                        <td><input type="text" name="addmore[0][email]" placeholder="Enter your email" class="form-control" /></td>  
                                        <td><input type="text" name="addmore[0][phone]" placeholder="Enter your phone" class="form-control" /></td>
                                        <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>  
                            @endif 
                        {{-- END FORM FUNCTION OLD --}}
                     {{-- END FORM CREATE --}}
                @elseif($company->id !== null)
                {{-- START FORM EDIT --}}
                    {{-- START FORM FUNCTION OLD --}}
                        @if (old('addmore') ?? $customers)
                            @foreach (old('addmore') ?? $customers as $key => $item)
                                <tr>  
                                    <td><input type="text" value="{{ $item['name'] ?? $item['name_customer']}}" name="addmore[{{ $key + 20 }}][name_customer]" placeholder="Enter your name_customer" class="form-control"></td>  
                                    <td><input type="text" value="{{ $item['email'] }}" name="addmore[{{ $key + 20 }}][email]" placeholder="Enter your email" class="form-control" /></td>  
                                    <td><input type="text" value="{{ $item['phone'] }}" name="addmore[{{ $key + 20 }}][phone]" placeholder="Enter your phone" class="form-control" /></td>
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

</div>

<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append(`<tr>  
                    <td><input type="text" name="addmore[`+i+`][name_customer]" placeholder="Enter your name_customer" class="form-control"></td>  
                    <td><input type="text" name="addmore[`+i+`][email]" placeholder="Enter your email" class="form-control" /></td>  
                    <td><input type="text" name="addmore[`+i+`][phone]" placeholder="Enter your phone" class="form-control" /></td>
                    <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td>  
                </tr>`);
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>