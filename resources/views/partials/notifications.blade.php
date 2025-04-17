@if(!empty(session('status')))
    <div class="notification notification-status">
        {{ session('status') }}
    </div>
@endif

@if(!empty(session('error')))
    <div class="notification notification-danger">
        {{ session('error') }}
    </div>
@endif

@if(!empty(session('success')))
    <div class="notification notification-success">
        {{ session('success') }}
    </div>
@endif

@if(!empty(session('warning')))
    <div class="notification notification-warning">
        {{ session('warning') }}
    </div>
@endif
