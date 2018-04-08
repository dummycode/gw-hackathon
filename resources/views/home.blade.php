@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="font-size: 28px">
                    Upcoming Events
                </div>
                <div class="card-header" style="font-size: 16px">
                    <nobr>
                        <input name="filter-option" type="checkbox" id="ifc" value="ifc" title="IFC" checked/> IFC
                        <input name="filter-option" type="checkbox" id="cpc" value="cpc" title="CPC" checked> CPC<br>
                        <input name="filter-option" type="checkbox" id="social" value="social" title="Social" checked/> Social
                        <input name="filter-option" type="checkbox" id="philanthropy" value="philanthropy" title="Philanthropy" checked/> Philanthropy<br>
                    </nobr>
                </div>

                <div class="card-body">
                    @foreach($events as $event)
                        <div id="event-card">
                            <a href="{{ route('viewevent', $event->id) }}" class="fill-div">
                                <h4>{{ $event->title }} - {{ $event->type }}</h4>
                                <p class="info">{{ $event->start }} - {{ $event->end }}</p>
                                <p class="info">{{ $event->location }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
