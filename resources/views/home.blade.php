@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 28px">Upcoming Events</div>

                <div class="card-body">
                    @foreach($events as $event)
                        <div id="event-card">
                            <a href="{{ route('viewevent', $event->id) }}" class="fill-div">
                                <h4>{{ $event->title }} - {{ $event->type }}</h4>
                                <p>{{ $event->start }} - {{ $event->end }}</p>
                                <p>{{ $event->location }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
