<x-back-layouts title="Show User">
    <x-back.breadcrumb page="Show User" />

    <div class="card">
        <div class="card-header">
            <div class="float-end">
                <a class="btn btn-warning text-white" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $user->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {{ $user->email }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Roles:</strong>
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <span class="badge badge-success">{{ $v }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-back-layouts>