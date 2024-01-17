<div class="row">
    <div class="col-sm-12 mt-3">
        <label for="invalid-state">Name Letter</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('name')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Enter Name Letter" 
        name="name"
        value="{{ $categoryLetter->name }}" 
        required>
        @error('name')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-12 mt-3">
        <label for="invalid-state">Code Letter</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('code_letter')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Enter Code Letter" 
        name="code_letter"
        value="{{ $categoryLetter->code_letter }}" 
        required>
        @error('code_letter')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

</div>