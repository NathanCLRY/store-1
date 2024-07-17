@extends('layouts.store')

@section('content')
<div class="container">
    <div class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">
        <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pb-8 pt-14 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">

            <div class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
                <div class="aspect-h-3 aspect-w-2 overflow-hidden rounded-lg bg-gray-100 sm:col-span-4 lg:col-span-5">
                    <img src="https://tailwindui.com/img/ecommerce-images/product-quick-preview-02-detail.jpg" alt="Two each of gray, white, and black shirts arranged on table." class="object-cover object-center">
                </div>
                <div class="sm:col-span-8 lg:col-span-7">
                    <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{$product->nom}}</h2>

                    <section aria-labelledby="information-heading" class="mt-2">
                        <h3 id="information-heading" class="sr-only">Product information</h3>

                        <p class="text-2xl text-gray-900">{{$product->price}} €</p>
                    </section>

                    <section aria-labelledby="options-heading" class="mt-10">
                    <h3 id="options-heading" class="sr-only">Product options</h3>
                    <!-- Colors -->
                    <fieldset aria-label="Choose a color">
                        <legend class="text-sm font-medium text-gray-900">Description</legend>
                        <div class="mt-4 flex items-center space-x-3">
                            <p class="text-sm font-medium text-black">{{$product->description}}</p>
                        </div>
                    </fieldset>

                    <div class="flex flex-row gap-x-4">

                        <a href="{{route('panier.ajouter',$product)}}" class="mt-6 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Ajouter au panier</a>
                        <a href="{{route('product.favoris',$product)}}" class="mt-6 flex items-center justify-center rounded-md border border-indigo-600 bg-white px-8 py-3 text-base font-medium text-black focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            @if (isset($fav))
                                <i class="ri-heart-fill"></i>
                            @else
                                <i class="ri-heart-line"></i>
                            @endif
                        </a>
                    </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<x-product-card :products="$products" :favs="$favs" />
@endsection