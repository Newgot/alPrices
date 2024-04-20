@extends('master')

@section('content')
    @foreach($cities as $city)
        <h3>{{ $city->title }}</h3>
        <div class="row">
            <div class="col-3"><b>API_ID</b></div>
            <div class="col-1"><b>Image</b></div>
            <div class="col"><b>Цена покупки</b></div>
            <div class="col"><b>Цена продажи</b></div>
        </div>
        <hr>
        @foreach($city->equipmentList() as $equipment)
            <div class="row {{ $loop->iteration % 2 === 0 ? 'bg-secondary-subtle' : 'bg-light' }}">
                <div class="col-3"><p>{{ $equipment->title }}</p></div>
                <div class="col-1">
                    <img
                        src="https://render.albiononline.com/v1/item/{{ $equipment->title }}"
                        alt=""
                        width="50"
                    >
                </div>
                <div class="col"><p>{{ $equipment->sell_price }}</p></div>
                <div class="col {{ $equipment->buy_price > $equipment->sell_price ? 'bg-success' : '' }}">
                    <p>{{ $equipment->buy_price }}</p>
                </div>
            </div>
        @endforeach
        <br>
    @endforeach
@endsection
