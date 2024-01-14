@extends('layouts.app')

@section('content')
    <div class="card">
        @role('Admin')
        <P>aDMIN</P>
        @endrole
        @role('Cliente')
        <p>Cleinte</p>
        @endrole
    </div>
@endsection
