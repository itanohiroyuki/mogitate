@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="register-form__content">
        <div class="register-form__heading">
            <h2 class="register-form__heading-title">商品登録</h2>
        </div>
        <form class="register-form" action="/products/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="register-form__group">
                <div class="register-form__title">
                    <label class="register-form__label">
                        商品名<span class="require">必須</span>
                    </label>
                </div>
                <div class="register-form__input">
                    <input type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
                    <div class="form__error">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>


            <div class="register-form__group">
                <div class="register-form__title">
                    <label class="register-form__label">
                        値段<span class="require">必須</span>
                    </label>
                </div>
                <div class="register-form__input">
                    <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
                    <div class="form__error">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>


            <div class="register-form__group">
                <div class="register-form__title">
                    <label class="register-form__label" for="image">
                        商品画像<span class="require">必須</span>
                    </label>
                </div>
                @php
                    $preview =
                        isset($product) && $product->image
                            ? asset('storage/' . $product->image)
                            : asset('storage/images/sample.png');
                @endphp
                <div style="margin-top:10px;">
                    <img src="{{ $preview }}" style="max-width:200px;">
                </div>

                <input type="file" name="image" id="image" accept="image/*">
                @error('image')
                    <div class="form__error">{{ $message }}</div>
                @enderror
            </div>

            <div class="register-form__group">
                <div class="register-form__title">
                    <label class="register-form__label">
                        季節<span class="require">必須</span>
                        <span class="span_2">複数選択可</span>
                    </label>
                </div>
                <div class="register-form__input">
                    @foreach ($seasons as $season)
                        <label>
                            <input type="checkbox" name="season_ids[]" value="{{ $season->id }}">
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
                <div class="form__error">
                    @error('season_ids')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="register-form__group">
                <label class="register-form__label" for="description">
                    商品説明<span class="require">必須</span>
                </label>

                <textarea class="register-form__textarea" name="description" id="description" cols="30" rows="10"
                    placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                <div class="form__error">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__button">
                <a class="form__button-return" href="{{ route('products.index') }}">戻る</a>
                <button class="form__button-register" type="submit">
                    登録
                </button>
            </div>
        </form>
    </div>
@endsection
