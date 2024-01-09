@extends('layouts.app')

@section('title', '書籍詳細')

@section('content')

    <form action="{{ url('books') }}" method="post" class="row">
        {{ csrf_field() }}
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-book"></i>書籍名</div>
                </div>
                <input disabled class="form-control bg-light" style="font-size:24px" value="{{ old('item_name', isset($book->item_name) ? $book->item_name : '') }}">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-sort-numeric-asc"></i>購入数</div>
                </div>
                <input disabled class="form-control bg-light" style="font-size:24px" value="{{ old('item_purchase', isset($book->item_purchase) ? $book->item_purchase : '') }}冊">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-money"></i>料金</div>
                </div>
                <input disabled class="form-control bg-light" style="font-size:24px" value="{{ number_format(old('item_amount', isset($book->item_amount) ? $book->item_amount : '')) }}円">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar-o"></i>販売日</div>
                </div>
                <input disabled class="form-control bg-light" style="font-size:24px" value="{{ old('published', isset($book->published) ? date('Y年m月d日 H:i:s', strtotime($book->published)) : '') }}"
                    id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker">
            </div>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg btn-block">
                <i class="fa fa-mail-reply"></i>一覧に戻る
            </a>
    </form>
@endsection
