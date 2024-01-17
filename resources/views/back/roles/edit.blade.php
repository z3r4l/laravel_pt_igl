<x-back-layouts title="Edit Role">
    <x-back.breadcrumb page="Edit Role" />
    <div class="row">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>

                <form action="{{ route('roles.update', $role->id) }}" method="POST" id="myForm">
                    @csrf
                    @method('PATCH')
                    @include('back.roles.__form')
                </form>
            </div>
        </div>
    </div>
</x-back-layouts>