<x-back-layouts title="Edit Invoice">
    <x-back.breadcrumb page="Edit Invoice" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    @include('back.partial.buttonBack')
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('invoice.update', $invoice->id) }}" enctype="multipart/form-data" method="POST" id="myForm">
                    @method('put')
                    @csrf
                    @include('back.invoice.__form')
            </div>
            <div>
                <button type="submit" class="btn btn-primary m-3" id="buttonSubmit"onclick="disableButton();">Save</button>
            </div>
            </form>
        </div>
    </div>
</x-back-layouts>