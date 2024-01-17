<x-back-layouts title="Create User">
    <x-back.breadcrumb page="Create User" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    @include('back.partial.buttonBack')
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('daily-report.update', $dailyReport->id) }}" enctype="multipart/form-data" method="POST" id="myForm">
                    @method('PUT')
                    @csrf
                    @include('back.daily-report.__form')
            </div>
            <div>
                <button type="submit" class="btn btn-primary m-3" id="buttonSubmit"onclick="disableButton();">Save</button>
            </div>
            </form>
        </div>
    </div>
</x-back-layouts>