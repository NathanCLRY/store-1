<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Commande;
use App\Models\CommandeItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CommandeController extends Controller
{
    //Création de la commande et ajout des élements dans CommandeItems
    public function create()
    {
        $paniers = Panier::where('user_id', auth()->user()->id)
            ->get();

        if (count($paniers) == 0) {
            return 'vide';
        }
        //Création de la commande
        $commande = Commande::create([
            'user_id' => auth()->user()->id,
            'numero' => 0,
            'total' => 0,
        ]);

        //Lecture du panier
        $total = 0;
        foreach ($paniers as $panier) {
            $commandeId = $commande->id;
            $productId = $panier->product->id;
            $quantite = $panier->quantite;
            $price = $panier->product->price;
            $total += $price * $quantite;
            //Ajout dans la table Commande item
            CommandeItem::create([
                'commande_id' => $commandeId,
                'product_id' => $productId,
                'quantite' => $quantite,
                'price' => $price,
            ]);
        }

        //Mise a jour du total de la commande
        $commande->update([
            'numero' => 9999,
            'total' => $total
        ]);
        $commande->save();

        Panier::where('user_id', auth()->user()->id)->delete();

        return redirect($this->stripeCheckout($total, $commande->id));
    }

    public function index()
    {
        $commandes = Commande::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('commande.liste', compact('commandes'));
    }

    public function stripeCheckout($total, $numero)
    {
        //Paramétrage de l'api
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        //URL de confirmation de paiement
        $redirectUrl = route('commande.liste') . '?session_id={CHECKOUT_SESSION_ID}';
        //Création de la session de paiement stripe
        $response =  $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'payment_method_types' => ['link', 'card'],
            'line_items' => [
                [
                    'price_data'  => [
                        'product_data' => [
                            'name' => $numero,
                        ],
                        'unit_amount'  => 100 * $total,
                        'currency'     => 'EUR',
                    ],
                    'quantity'    => 1
                ],
            ],
            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        //Géneration de l'url de paiement
        return $response['url'];
    }
}
