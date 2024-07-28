@if (!empty(session('success')))
    <div class="alert alert-success" id="alert" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger" id="alert" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (!empty(session('payment-error')))
    <div class="alert alert-error" id="alert" role="alert">
        {{ session('payment-error') }}
    </div>
@endif

@if (!empty(session('warning')))
    <div class="alert alert-warning" id="alert" role="alert">
        {{ session('warning') }}
    </div>
@endif

@if (!empty(session('info')))
    <div class="alert alert-info" id="alert" role="alert">
        {{ session('info') }}
    </div>
@endif


@if (!empty(session('secondary')))
    <div class="alert alert-secondary" id="alert" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (!empty(session('primary')))
    <div class="alert alert-primary" id="alert" role="alert">
        {{ session('primary') }}
    </div>
@endif

@if (!empty(session('light')))
    <div class="alert  alert-light" id="alert" role="alert">
        {{ session('light') }}
    </div>
@endif
