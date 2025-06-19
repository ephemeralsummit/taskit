@if (auth()->check() && auth()->user()->role_id == 1)
    {{ $admin ?? '' }}
@endif
