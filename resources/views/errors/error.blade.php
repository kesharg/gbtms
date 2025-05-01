@if (count($errors) > 0)
<div class="alert alert-danger ml-2 mr-5 mt-3">
    <strong>Oh no!</strong>&nbsp;&nbsp;Please address the following error(s) to proceed</br></br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
