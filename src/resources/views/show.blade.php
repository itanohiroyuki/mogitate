@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@section('content')
    <div class="edit-content">
        <form class="edit-form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="detail-1">
                <div class="image-data__title"><a href="{{ url('/products') }}">商品一覧</a>{{ $product->name }}
                </div>
                <div class="image-data">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                    {{-- ファイル選択 --}}
                </div>


                <div class="edit-form__groupe">
                    <div class="edit-form__title">
                        <label class="edit-form__title-label">
                            商品名
                        </label>
                    </div>
                    <input class="edit-form__input" type="text" name="name" value="{{ $product->name }}" />
                </div>

                <div class="edit-form__groupe">
                    <label class="edit-form__title-label">
                        値段
                    </label>
                    <input class="edit-form__input" type="text" name="price"
                        value="{{ number_format($product->price) }}" />
                </div>

                <div class="edit-form__groupe">
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
                </div>
            </div>



            <div class="detail-2">
                <div class="product-title">商品説明</div>
                <div class="product-description">
                    <textarea name="description" id="description" cols="30" rows="10">{{ $product->description }}</textarea>
                </div>
            </div>



            <div class="detail-3">
                <a class="return-button" href="{{ url('/products') }}">戻る</a>

                <button class="edit-button" type="submit">変更を保存</button>
            </div>
        </form>
        <form action="/products/{{ $product->id }}/delete" method="post" style="margin-top:10px;">
            @csrf
            @method('DELETE')
            <button class="delete-button" type="submit"><img class="btn-icon" src="{{ asset('storage/images/') }}"
                    width="16" />削除</button>
        </form>


    </div>
@endsection
