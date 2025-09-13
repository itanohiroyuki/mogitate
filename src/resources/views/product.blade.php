@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
<style>
    svg.w-5.h-5 {
        width: 30px;
        height: 30px;
    }
</style>

@section('content')
    <div class="product__content">
        <div class="product__heading">
            <h2>商品一覧</h2>
            <div class="product__button">
                <a class="product__button--register" href="products/register">+商品を追加</a>
            </div>
        </div>

        <form class="search-form" action="/products/search" method="get">
            <div class="search-form__item">
                <input class="search-form__item-input" type="text" name="keyword" placeholder="商品名で検索"
                    value="{{ request('keyword') }}" />
                <div class="search-form__button">
                    <button class="search-form__button-submit" type="submit">検索</button>
                </div>
            </div>
            <div class="search-form__item">
                <h3>価格順で表示</h3>
                <select class="search-form__item-select" name="" id=""></select>
            </div>
        </form>
        <div class="product__item">
            <div class="product__item-list">
                @foreach ($products as $product)
                    <div class="product-card">
                        <a href="{{ route('products.show', ['productId' => $product->id]) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            <p>{{ $product->name }}</p>
                            <p>¥{{ number_format($product->price) }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
