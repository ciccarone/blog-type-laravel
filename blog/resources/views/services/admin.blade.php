@extends('main')

@section('content')

@if(session()->get('success'))
  {{ session()->get('success') }}
@endif

<div class="row">
  <div class="cell">
    ID
  </div>
  <div class="cell">
    Service Name
  </div>
  <div class="cell">
    Service Parent
  </div>
  <div class="cell">

  </div>
  <div class="cell">

  </div>
</div>
@foreach($services as $service)
<div class="row">
  <div class="cell">
    {{$service->id}}
  </div>
  <div class="cell">
    {{$service->service_name}}
  </div>
  <div class="cell">
    @if ($service->service_parent)
      {{ $keyed_services[$service->service_parent] }}
    @endif

  </div>
  <div class="cell">
    <a href="{{ route('services.edit', $service->id)}}" class="btn btn-primary">Edit</a>
  </div>
  <div class="cell">
    <form action="{{ route('services.destroy', $service->id)}}" method="post">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger" type="submit">Delete</button>
    </form>
  </div>
</div>
@endforeach

@endsection
