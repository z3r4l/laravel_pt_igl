<x-back-layouts title="Create Company">
    <x-back.breadcrumb page="Create Company" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    @include('back.partial.buttonBack')
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('company.store') }}" enctype="multipart/form-data" method="POST" id="myForm">
                    @csrf
                    @include('back.company.__form')
            </div>
            <div>
                <button type="submit" class="btn btn-primary m-3" id="buttonSubmit"onclick="disableButton();">Save</button>
            </div>
            </form>
        </div>
    </div>
</x-back-layouts>