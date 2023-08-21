@extends('layouts.app')

@section('title', "Wishlist")


@section('content')

<div class="container">
    <table class="table" style="margin-top:20px">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Seller</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $key => $item)
            <tr>
                <th scope="row">{{++$key}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->seller ? $item->seller->name : ''}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection