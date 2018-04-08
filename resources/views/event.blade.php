@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="font-size: 28px">
                        <button>
                            <span class="glyphicon glyphicon-print"></span>
                        </button>
                        {{ $event->title }} - {{ $event->type }}
                    </div>

                    <div class="card-body">
                        <p><b>Date</b>: {{ $event->start }} - {{ $event->end }} </p>
                        <p><b>Location</b>: {{ $event->location }} </p>
                        @if($event->description)
                            <p><b>Description</b>: {{ $event->description }} </p>
                        @endif
                        @if($event->website)
                            <p><b>Website</b>: {{ $event->website }} </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
