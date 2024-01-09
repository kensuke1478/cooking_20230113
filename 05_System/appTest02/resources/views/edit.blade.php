@extends('layouts.app')

@section('title', '書籍の編集')

@section('content')

<form action="{{ url('books/'.$book->id) }}" method="post" class="row">
    <input type='hidden' name='user_id' value="{{ Auth::user()->id }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group col-md-6 col-xs-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-book"></i>書籍名</div>
                </div>
                <input type="text" name="item_name" class="form-control"value="{{ old('item_name', isset($book->item_name) ? $book->item_name : '') }}" autofocus>
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-sort-numeric-asc"></i>購入数</div>
                </div>
                <select class="custom-select" name="item_purchase">
                    <option selected>選択してください</option>
                    @for ($i = 1; $i <= 10; $i++)
                        @if(old('item_purchase', isset($book->item_purchase) ? $book->item_purchase : '') == $i)
                            <option value="{{ $i }}" selected>{{ $i }}冊</option>
                        @else
                            <option value="{{ $i }}">{{ $i }}冊</option>
                        @endif
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-money"></i>料金</div>
                </div>
                <input type="number" name="item_amount" class="form-control" placeholder="例:3000" value="{{ old('item_amount', isset($book->item_amount) ? $book->item_amount : '') }}">
            </div>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-calendar-o"></i>販売日</div>
                </div>
                <input type="datetime" name="published" class="form-control datetimepicker-input"
                    value="{{ old('published', isset($book->published) ? date('Y-m-d', strtotime($book->published)) : '') }}"
                    id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker">
            </div>
        </div>
        <div class="form-group col-3">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-lg btn-block">
                <i class="fa fa-mail-reply"></i>キャンセル
            </a>
        </div>
        <div class="form-group col-9">
            <button type="submit" class="btn btn-secondary btn-lg btn-block">
                <i class="fa fa-chevron-right"></i>送信</button>
        </div>
    </form>
@endsection
