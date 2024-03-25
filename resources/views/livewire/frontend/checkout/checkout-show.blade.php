<div>

    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <h4>Checkout</h4>
            <hr>

            @if ($this->totalProductAmount != '0')
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Item Total Amount :
                            <span class="float-end">Rp. {{ number_format($this->totalProductAmount) }}</span>
                        </h4>
                        <hr>
                        <small>* Items will be delivered in 3 - 5 days.</small>
                        <br/>
                        <small>* Tax and other charges are included ?</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="text-primary">
                            Basic Information
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" wire:model.defer="fullname" id="fullname" class="form-control" placeholder="Enter Full Name" />
                                @error ('fullname') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone Number</label>
                                <input type="number" wire:model.defer="phone" id="phone" class="form-control" placeholder="Enter Phone Number" />
                                @error ('phone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email Address</label>
                                <input type="email" wire:model.defer="email" id="email" class="form-control" placeholder="Enter Email Address" />
                                @error ('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Pin-code (Zip-code)</label>
                                <input type="number" wire:model.defer="pincode" id="pincode" class="form-control" placeholder="Enter Pin-code" />
                                @error ('pincode') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Full Address</label>
                                <textarea wire:model.defer="address" id="address" class="form-control" rows="2"></textarea>
                                @error ('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-12 mb-3"  wire:ignore>
                                <label>Select Payment Mode: </label>
                                <div class="d-md-flex align-items-start">
                                    <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                        <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                    </div>
                                    <div class="tab-content col-md-9" id="v-pills-tabContent">
                                        <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                            <h6>Cash on Delivery Mode</h6>
                                            <hr/>
                                            <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary">
                                                <span wire:loading.remove wire:target="codOrder">
                                                    Place Order (Cash on Delivery)
                                                </span>
                                                <span wire:loading wire:target="codOrder">
                                                    Placeing Order
                                                </span>
                                            </button>

                                        </div>
                                        <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                            <h6>Online Payment Mode</h6>
                                            <hr/>
                                            <div>
                                                <button type="button" class="btn btn-warning" id="pay-button">Pay Now (Online Payment)</button>
                                                <!-- @TODO: You can add the desired ID as a reference for the embedId parameter. -->
                                                <div id="snap-container"></div>
                                                {{-- <button id="pay-button">Pay</button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
            @else
                <div class="card card-body shadow text-center p-md-5">
                    <h4>Tidak Ada Barang Di Cart</h4>
                    <a href="{{ url('collections') }}" class="btn btn-primary">Belanja Sekarang</a>
                </div>
            @endif
        </div>
    </div>


</div>

@push('scripts')

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

    <script type="text/javascript">

        document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay($snapToken, {
                // Optional
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                // dd($snapToken);
                });
            };



    //     document.getElementById('pay-button').onclick = function(){
    //     // SnapToken acquired from previous step
    //     snap.pay('<?=$snapToken?>', {
    //       // Optional
    //       onSuccess: function(result){
    //         /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
    //       },
    //       // Optional
    //       onPending: function(result){
    //         /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
    //       },
    //       // Optional
    //       onError: function(result){
    //         /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
    //       }
    //     });
    //   };


        // For example trigger on button clicked, or any time you need
    // var payButton = document.getElementById('pay-button');
    // payButton.addEventListener('click', function () {

    // coba coba aja awal
    // if(!document.getElementById('fullname').value
    //     || !document.getElementById('phone').value
    //     || !document.getElementById('email').value
    //     || !document.getElementById('pincode').value
    //     || !document.getElementById('address').value

    // )
    // {
    //     livewire.disparts('validationForAll');
    //     return false;
    // } else {

    //     @this.set('fullname', document.getElementById('fullname').value);
    //     @this.set('email', document.getElementById('email').value);
    //     @this.set('phone', document.getElementById('phone').value);
    //     @this.set('pincode', document.getElementById('pincode').value);
    //     @this.set('address', document.getElementById('address').value);

    // }
    // coba coba aja akhir


      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
      // Also, use the embedId that you defined in the div above, here.
    //   window.snap.embed($snapToken, {
    //     embedId: 'snap-container'
    //   });
    // });
  </script>

@endpush

