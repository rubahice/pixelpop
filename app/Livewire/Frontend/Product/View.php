<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class View extends Component
{
    use LivewireAlert;
    public $category, $product, $prodColorSelectedQuantity;

    public function addToWishLish($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                // session()->flash('message', 'Sudah ditambahkan ke Wishlist');
                $this->alert('info', 'Sudah di Wishlist', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Sudah Ditambahkan Wishlist',
                    'background' => '#cee9ff',
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);

                // session()->flash('message', 'Berhasil ditambahkan ke Wishlist');
                
                $this->alert('success', 'Berhasil', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Berhasil Ditambahkan Wishlish',
                    'background' => '#CDFADB',
                ]);
            }
        } else {

            // session()->flash('message','Silahkan Login Terlebih Dahulu');
            $this->alert('warning', 'Login dulu', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Silahkan Login Dulu',
                'width' => '280',
                'background' => '#FFDCA9',
            ]);
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        // dd($productColorId);
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
