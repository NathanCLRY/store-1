@extends('layouts.store')

@section('content')
@php
    $total= 0;
    $nbrArticle=0;
@endphp
<div class="flex flex-col md:flex-row w-screen h-full px-14 py-7">

    <!-- My Cart -->
    <div class="w-full flex flex-col h-fit gap-4 p-4 ">
        <p class="text-blue-900 text-xl font-extrabold">Mon panier</p>
        @forelse ($paniers as $panier)
            @php
                $total += $panier->product->price * $panier->quantite;
                $nbrArticle += $panier->quantite
            @endphp
            <!-- component -->

        <!-- Product -->
        <div class="flex flex-col p-4 text-lg font-semibold shadow-md border rounded-sm">
            <div class="flex flex-col md:flex-row gap-3 justify-between">
                <!-- Product Information -->
                <div class="flex flex-row gap-6 items-center">
                    <div class="w-28 h-28">
                        <img class="w-full h-full" src="https://static.netshoes.com.br/produtos/tenis-adidas-coreracer-masculino/09/NQQ-4635-309/NQQ-4635-309_zoom1.jpg?ts=1675445414&ims=544x">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-lg text-gray-800 font-semibold">{{$panier->product->nom}}</p>
                    </div>
                </div>
                <!-- Price Information -->
                <div class="self-center text-center">
                    <p class="text-gray-800 font-normal text-xl">{{$panier->product->price}} €</p>
                </div>
                <!-- Remove Product Icon -->
                <div class="self-center">
                    <a href="{{route('panier.remove',$panier)}}" class="">
                        <svg class="" height="24px" width="24px" id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512"  xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g>
                            <path d="M400,113.3h-80v-20c0-16.2-13.1-29.3-29.3-29.3h-69.5C205.1,64,192,77.1,192,93.3v20h-80V128h21.1l23.6,290.7   c0,16.2,13.1,29.3,29.3,29.3h141c16.2,0,29.3-13.1,29.3-29.3L379.6,128H400V113.3z M206.6,93.3c0-8.1,6.6-14.7,14.6-14.7h69.5   c8.1,0,14.6,6.6,14.6,14.7v20h-98.7V93.3z M341.6,417.9l0,0.4v0.4c0,8.1-6.6,14.7-14.6,14.7H186c-8.1,0-14.6-6.6-14.6-14.7v-0.4   l0-0.4L147.7,128h217.2L341.6,417.9z"/>
                            <g>
                            <rect height="241" width="14" x="249" y="160"/>
                            <polygon points="320,160 305.4,160 294.7,401 309.3,401"/>
                            <polygon points="206.5,160 192,160 202.7,401 217.3,401"/>
                            </g>
                        </g>
                        </svg>
                    </a>
                </div>
            </div>
            <!-- Product Quantity -->
            <div class="flex flex-row self-center gap-1">
                <a href="{{route('panier.moins',$panier)}}" class="w-5 h-5 self-center rounded-full border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                    </svg>
                </a>
                <input type="text" readonly="readonly" value="{{$panier->quantite}}" class="w-8 h-8 text-center text-gray-900 text-sm outline-none border border-gray-300 rounded-sm">
                <a href="{{route('panier.ajouter',$panier->product)}}" class="w-5 h-5 self-center rounded-full border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                </a>
            </div>
        </div>
        @empty
        <p class="text-sm font-semibold leading-6 text-gray-900">Il n'y a pas d'article</p>
        @endforelse
        
    </div>
        <!-- Purchase Resume -->
        <div class="flex flex-col w-full md:w-2/3 h-fit gap-4 p-4">
            <p class="text-blue-900 text-xl font-extrabold">Resumé de la commande</p>
            <div class="flex flex-col p-4 gap-4 text-lg font-semibold shadow-md border rounded-sm">
                <div class="flex flex-row justify-between">
                    <p class="text-gray-600">Prix total ({{$nbrArticle}} produit)</p>
                    <p class="text-end font-bold">$99.98</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{route('commande.create')}}" class="transition-colors text-sm bg-blue-600 hover:bg-blue-700 p-2 rounded-sm w-full text-white text-hover shadow-md text-center">
                            Commander  
                    </a>
                    <a href="{{route('product')}}" class="transition-colors text-sm bg-white border border-gray-600 p-2 rounded-sm w-full text-gray-700 text-hover shadow-md text-center">
                            Ajouter des produits
                    </a>
                </div>
            </div>
        </div>
    </div>
        
@endsection