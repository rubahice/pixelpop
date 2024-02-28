<?php

namespace App\Livewire\Frontend;

use App\Models\Wishlist;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class WishlistShow extends Component
{
    use LivewireAlert;
    public function removeWishlishItem(int $wishlistId)
    {
        Wishlist::where('user_id', auth()->user()->id)->where('id',$wishlistId)->delete();

            $this->alert('success', 'Berhasil', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => 'Wishlist Item Berhasil Remove',
                'background' => '#CDFADB',
            ]);
    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist
        ]);
    }
}
