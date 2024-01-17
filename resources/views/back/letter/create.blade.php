<x-back-layouts title="Create Letter">
    <x-back.breadcrumb page="Create Letter" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    @include('back.partial.buttonBack')
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('letter.store') }}" enctype="multipart/form-data" method="POST" id="myForm">
                    @csrf
                    @include('back.letter.__form')
            </div>
            <div>
                <button type="submit" class="btn btn-primary m-3" id="buttonSubmit"onclick="disableButton();">Save</button>
            </div>
            </form>
        </div>
    </div>
</x-back-layouts>