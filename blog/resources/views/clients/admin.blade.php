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
    Client Name
  </div>
  <div class="cell">
    Client Logo
  </div>
  <div class="cell">

  </div>
  <div class="cell">

  </div>
</div>
@foreach($clients as $client)
<div class="row">
  <div class="cell">
    {{$client->id}}
  </div>
  <div class="cell">
    {{$client->client_name}}
  </div>
  <div class="cell">
    {{$client->client_logo}}
  </div>
  <div class="cell">
    <a href="{{ route('clients.edit', $client->id)}}" class="btn btn-primary">Edit</a>
  </div>
  <div class="cell">
    <form action="{{ route('clients.destroy', $client->id)}}" method="post">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger" type="submit">Delete</button>
    </form>
  </div>
</div>
@endforeach

@endsection
