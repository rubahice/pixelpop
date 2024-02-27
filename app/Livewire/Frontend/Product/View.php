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
                session()->flash('message', 'Sudah ditambahkan ke Wishlist');
                $this->dispatch('message', [
                    'text' => 'Sudah ditambahkan ke Wishlist',
                    'type' => 'success',
                    'status' => 409
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                // session()->flash('message', 'Berhasil ditambahkan ke Wishlist');
                // $this->dispatch('message', [
                //     'text' => 'Berhasil ditambahkan ke Wishlist',
                //     'type' => 'success',
                //     'status' => 200
                // ]);
                $this->alert('success', 'Berhasil', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Berhasil Menambahkan wishlish',
                ]);
            }
        } else {
            // session()->flash('message','Silahkan Login Terlebih Dahulu');
            // $this->dispatch('message', [
            //     'text' => 'Silahkan Login Terlebih Dahulu',
            //     'type' => 'info',
            //     'status' => 401
            // ]);
            $this->alert('warning', 'Perikasa', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Login dulu',
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
