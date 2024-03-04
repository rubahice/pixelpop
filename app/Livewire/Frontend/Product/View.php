<?php

namespace App\Livewire\Frontend\Product;

use App\Livewire\Frontend\WishlistCount;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class View extends Component
{
    use LivewireAlert;
    public $category, $product, $prodColorSelectedQuantity ,$quantityCount = 1, $productColorId;

    public function addToWishLish($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                // session()->flash('message', 'Sudah ditambahkan ke Wishlist');
                $this->alert('info', 'Sudah di Wishlist', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Sudah Ditambahkan ke Wishlist',
                ]);
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->dispatch('wishlistUpdated')->to(WishlistCount::class);
                // session()->flash('message', 'Berhasil ditambahkan ke Wishlist');

                $this->alert('success', 'Berhasil', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Berhasil Ditambahkan Wishlish',
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
            ]);
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        // dd($productColorId);
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 20){
            $this->quantityCount++;
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check())
        {
            // dd($productId);
            if($this->product->where('id',$productId)->where('status','0')->exists())
            {
                // periksa jumlah warna produk tambahkan ke keranjang
                if($this->product->productColors()->count() > 1)
                {
                    if($this->prodColorSelectedQuantity != NULL)
                    {
                        if(Cart::where('user_id',auth()->user()->id)
                                ->where('product_id', $productId)
                                ->where('product_color_id', $this->productColorId)
                                ->exists())
                        {
                            $this->alert('info', 'Sudah Di Cart', [
                                'position' => 'top-end',
                                'timer' => 3000,
                                'toast' => true,
                                'text' => 'Sudah Ditambahkan ke Cart',
                            ]);
                        }
                        else
                        {
                            $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                            if($productColor->quantity > 0)
                            {
                                if($productColor->quantity > $this->quantityCount)
                                {
                                    // masukkan product ke cart
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);

                                    $this->dispatch('CartAddedUpdated');
                                    $this->alert('success', 'success', [
                                        'position' => 'top-end',
                                        'timer' => 3000,
                                        'toast' => true,
                                        'text' => 'Product Ditambahkan ke Cart',
                                    ]);
                                }
                                else
                                {
                                    $this->alert('warning', 'Tidak Tersedia', [
                                        'position' => 'top-end',
                                        'timer' => 3000,
                                        'toast' => true,
                                        'text' => 'Hanya '.$productColor->quantity.' Jumlah yang Tersedia',
                                    ]);
                                }

                            } else {

                                $this->alert('error', 'Tidak Ditemukan', [
                                    'position' => 'top-end',
                                    'timer' => 3000,
                                    'toast' => true,
                                    'text' => 'Produk Kehabisan Stok',
                                ]);
                            }
                        }
                    }
                    else
                    {
                        $this->alert('info', 'Pilih Dulu', [
                            'position' => 'top-end',
                            'timer' => 3000,
                            'toast' => true,
                            'text' => 'Pilih Warna Terlebih Dulu',
                        ]);
                    }
                }
                else
                {
                    if(Cart::where('user_id',auth()->user()->id)->where('product_id', $productId)->exists())
                    {
                        $this->alert('info', 'Sudah Di Cart', [
                            'position' => 'top-end',
                            'timer' => 3000,
                            'toast' => true,
                            'text' => 'Sudah Ditambahkan ke Cart',
                        ]);
                    }
                    else
                    {
                        if($this->product->quantity > 0)
                        {
                            if($this->product->quantity > $this->quantityCount)
                            {
                                // masukkan product ke cart
                                // dd('Tambahkan Kedalam Cart Tanpa Warna');
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);

                                $this->dispatch('CartAddedUpdated');
                                $this->alert('success', 'success', [
                                    'position' => 'top-end',
                                    'timer' => 3000,
                                    'toast' => true,
                                    'text' => 'Product Ditambahkan ke Cart',
                                ]);
                            }
                            else
                            {
                                $this->alert('warning', 'Tidak Tersedia', [
                                    'position' => 'top-end',
                                    'timer' => 3000,
                                    'toast' => true,
                                    'text' => 'Hanya '.$this->product->quantity.' Jumlah yang Tersedia',
                                ]);
                            }

                        }
                        else
                        {
                            $this->alert('error', 'Tidak Ditemukan', [
                                'position' => 'top-end',
                                'timer' => 3000,
                                'toast' => true,
                                'text' => 'Produk Kehabisan Stok',
                            ]);
                        }
                    }
                }
            }
            else
            {
                $this->alert('error', 'Tidak Ditemukan', [
                    'position' => 'top-end',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => 'Produk Tidak Ditemukan',
                ]);
            }
        }
        else
        {
            $this->alert('warning', 'Login dulu', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Silahkan Login Dulu',
                'width' => '280',
            ]);
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
