@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@section('content')
    <div class="show-content">
        <form class="show-form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="image-data__name"><a class="return"href="{{ url('/products') }}">商品一覧</a>>{{ $product->name }}
            </div>
            <div class="detail-1">
                <div class="image-data">
                    <div class="register-form__title">
                        <label class="register-form__label" for="image">
                            商品画像
                        </label>
                    </div>
                    @php
                        $preview =
                            isset($product) && $product->image
                                ? asset('storage/' . $product->image)
                                : asset('storage/images/sample.png');
                    @endphp
                    <div class="image-data__preview">
                        <img class="image-data__img" src="{{ $preview }}">
                    </div>

                    <input class="image-data__input" type="file" name="image" id="image" accept="image/*">
                    @error('image')
                        <div class="form__error">{{ $message }}</div>
                    @enderror
                </div>


                <div class="show-form__groups">
                    <div class="show-form__group">
                        <div class="show-form__title">
                            <label class="show-form__title-label">
                                商品名
                            </label>
                        </div>
                        <input class="show-form__input" type="text" name="name" value="{{ $product->name }}" />
                        <p class="form__error">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="show-form__group">
                        <label class="show-form__title-label">
                            値段
                        </label>
                        <input class="show-form__input" type="text" name="price" value="{{ $product->price }}" />
                        <p class="form__error">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="show-form__group">
                        <label class="register-form__label">
                            季節
                        </label>
                        <div class="register-form__input">
                            @foreach ($seasons as $season)
                                <label>
                                    <input type="checkbox" name="season_ids[]" value="{{ $season->id }}"
                                        {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                                    {{ $season->name }}
                                </label>
                            @endforeach
                        </div>
                        <p class="form__error">
                            @error('season_ids')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>
            </div>



            <div class="detail-2">
                <div class="product-title">商品説明</div>
                <div class="product-description">
                    <textarea name="description" id="description" cols="30" rows="10">{{ $product->description }}</textarea>
                </div>
                <p class="form__error">
                    @error('description')
                        {{ $message }}
                    @enderror
                </p>
            </div>


            <div class="detail-3">
                <div class="edit-form__button">
                    <a class="edit-form__button-return" href="{{ url('/products') }}">戻る</a>

                    <button class="edit-form__button-edit" type="submit">変更を保存</button>
                </div>
        </form>

        <form class="delete-form" action="/products/{{ $product->id }}/delete" method="post" style="margin-top:10px;">
            @csrf
            @method('DELETE')
            <button class="delete-button" type="submit"><img class="btn-icon" src="{{ asset('storage/images/') }}"
                    width="16" />削除</button>
        </form>
    </div>

    </div>
@endsection
