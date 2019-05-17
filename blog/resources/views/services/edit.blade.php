@extends('main')

@section('content')

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
@endif




<form method="post" action="{{ route('services.update', $service->id) }}">
  @method('PATCH')
  @csrf
  <div class="row">
    <div class="cell">
      <input type="text" class="form-control" name="service_name" value="{{ $service->service_name }}" placeholder="Service Name" />
    </div>
    <div class="cell">
      <input type="text" class="form-control" name="service_description" value="{{ $service->service_description }}" placeholder="Service Description" />
    </div>
    <div class="cell">
      <select name="service_parent">
        <option value="">Select Parent</option>
        @foreach ($services as $service_list_item)
          @if ($service->id !== $service_list_item->id)
            @if ($service->service_parent == $service_list_item->id)
              <option value="{{ $service_list_item->id }}" selected>{{ $service_list_item->service_name }}</option>
            @else
              <option value="{{ $service_list_item->id }}">{{ $service_list_item->service_name }}</option>
            @endif
          @endif
        @endforeach
      </select>
    </div>
    <div class="cell">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>

</form>

@endsection
