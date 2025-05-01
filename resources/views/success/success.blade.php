@if ($message = Session::get('success'))
<div class="alert alert-success mt-2 mb-2">
    <span>{{ $message }}</span>
</div>
@endif
