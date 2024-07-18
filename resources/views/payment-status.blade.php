@extends('layouts.app')
@section('content')
    @if ($status_id == 1)
        <p>Payment Successful!</p>
    @else
        <p>Payment Failed.</p>
    @endif
@endsection
