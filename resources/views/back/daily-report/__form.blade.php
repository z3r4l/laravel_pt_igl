<div class="row">
    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Jenis Dokumen</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('type_document')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan Jenis Dokumen" 
        name="type_document"
        value="{{ $dailyReport->type_document }}" 
        required>
        @error('type_document')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">No Pendaftaran</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('no_pendaftaran')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan No Dokumen" 
        name="no_pendaftaran" 
        value="{{ $dailyReport->no_pendaftaran }}"
        required>
        @error('no_pendaftaran')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Tanggal Dokumen</label>
        <input 
        type="date" 
        class="form-control mt-2 
        @error('date_document')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan Tanggal Dokumen" 
        name="date_document" 
        value="{{ $dailyReport->date_document }}"
        required>
        @error('date_document')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Shipper</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('shipper')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan Shipper" 
        name="shipper"
        value="{{ $dailyReport->shipper }}" 
        required>
        @error('shipper')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Consignee</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('consignee')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan consignee" 
        name="consignee" 
        value="{{ $dailyReport->consignee }}" 
        required>
        @error('consignee')
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
        @error('name_vessel')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan Vessel" 
        name="name_vessel" 
        value="{{ $dailyReport->name_vessel }}"
        required>
        @error('name_vessel')
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
        placeholder="Masukan Voy" 
        name="voy" 
        value="{{ $dailyReport->voy }}"
        required>
        @error('voy')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">NO BL</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('no_bl')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan No BL" 
        name="no_bl" 
        value="{{ $dailyReport->no_bl }}"
        required>
        @error('no_bl')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">NO Faktur Pajak</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('no_tax')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan No Faktur Pajak" 
        name="no_tax" 
        value="{{ $dailyReport->no_tax }}">
        @error('no_tax')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Tanggal Faktur Pajak</label>
        <input 
        type="date" 
        class="form-control mt-2 
        @error('date_faktur')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan No Faktur Pajak" 
        name="date_faktur" 
        value="{{ $dailyReport->date_faktur }}">
        @error('date_faktur')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>

    <div class="col-sm-6 mt-3">
        <label for="invalid-state">Keterangan Status</label>
        <input 
        type="text" 
        class="form-control mt-2 
        @error('status')
        is-invalid
        @enderror" 
        id="invalid-state" 
        placeholder="Masukan Keterangan Status" 
        name="status"
        value="{{ $dailyReport->status }}"
        >
        @error('status')
        <div class="invalid-feedback">
            <i class="bx bx-radio-circle"></i>
           {{$message}}
        </div>
        @enderror
    </div>


</div>