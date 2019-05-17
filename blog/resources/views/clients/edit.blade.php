@extends('main')

@section('content')

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
  @endforeach
@endif




<form method="post" action="{{ route('clients.update', $client->id) }}">
  @method('PATCH')
  @csrf
  <div class="row">
    <div class="cell">
      <input type="text" class="form-control" name="client_name" value="{{ $client->client_name }}" placeholder="Client Name" />
    </div>
    <div class="cell">
      <input type="text" class="form-control" name="client_description" value="{{ $client->client_description }}" placeholder="Client Description" />
    </div>
    <div class="cell">
      <input type="text" class="form-control" name="client_logo" value="{{ $client->client_logo }}" placeholder="Client Logo" />
    </div>
    <div class="cell">
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </div>

</form>

@endsection
