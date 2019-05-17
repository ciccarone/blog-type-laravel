@extends('main')

@section('content')

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
@endif

<form method="post" action="{{ route('services.store') }}">
  @csrf
  <div class="row">
    <div class="cell">
      <input type="text" class="form-control" name="service_name" placeholder="Service Name" />
    </div>
    <div class="cell">
      <input type="text" class="form-control" name="service_description" placeholder="Service Description" />
    </div>
    <div class="cell">
      <select name="service_parent">
        <option value="">Service Parent</option>
        @foreach ($services as $service)
          <option value="{{ $service->id }}">{{ $service->service_name }}</option>
        @endforeach
      </select>
    </div>
    <div class="cell">
      <button type="submit" class="btn btn-primary">Add</button>
    </div>
  </div>
</form>

@endsection
