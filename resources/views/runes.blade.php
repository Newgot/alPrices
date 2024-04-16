@extends('master')

@section('content')
    @foreach($cities as $city)
        <h3>{{ $city->title }}</h3>
        <div class="row">
            <div class="col-1"><b>API_ID</b></div>
            <div class="col-2"><b>Image</b></div>
            <div class="col"><b>Цена покупки</b></div>
        </div>
        <hr>
        @foreach($city->runes as $rune)
            <div class="row {{$loop->iteration % 2 === 0 ? 'bg-secondary-subtle' : 'bg-light'}}">
                <div class="col-1"><p>{{ $rune->title }}</p></div>
                <div class="col-2">
                    <img
                        src="https://render.albiononline.com/v1/item/{{ $rune->title }}"
                        alt=""
                        width="50"
                    >
                </div>
                <div class="col"><p>{{ $rune->price }}</p></div>
            </div>
        @endforeach
        <br>
    @endforeach
@endsection
