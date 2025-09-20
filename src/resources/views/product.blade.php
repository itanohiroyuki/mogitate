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
            <h2 class="product__title">商品一覧</h2>
            <a class="product__button-register" href="{{ url('products/register') }}">+商品を追加</a>
        </div>
        <div class="product__main">
            <form class="search-form" action="/products/search" method="get">
                <div class="search-form__item">
                    <input class="search-form__item-input" type="text" name="keyword" placeholder="商品名で検索"
                        value="{{ request('keyword') }}" />
                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit">検索</button>
                    </div>
                </div>
                <div class="search-form__item">
                    <h3 class="search-form__title">価格順で表示</h3>
                    <select class="search-form__item-select" name="sort" onchange="this.form.submit()">
                        <option value="">並び替え</option>
                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                    <div class="active-filters">
                        @if (request('sort') === 'high')
                            <span class="filter-tag">
                                高い順に表示
                                <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="filter-remove">✕</a>
                            </span>
                        @elseif(request('sort') === 'low')
                            <span class="filter-tag">
                                低い順に表示
                                <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="filter-remove">✕</a>
                            </span>
                        @endif
                    </div>
                </div>
            </form>
            <div class="product__item">
                <div class="product__item-list">
                    @foreach ($products as $product)
                        <div class="product-card">
                            <a class="product-card__img" href="{{ route('products.show', ['productId' => $product->id]) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                <div class="product-card__title">
                                    <span>{{ $product->name }}</span>
                                    <span>¥{{ $product->price }}</span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
