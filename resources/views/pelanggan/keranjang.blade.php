@extends('layout.layoutUser')

@section('contentUser')

<!-- Page Header Start -->
<div class="container-fluid mb-5" style="background-color: #ffc40c;">
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
    <h1 class="font-weight-semi-bold text-uppercase mb-3 text-white">Keranjang Belanja</h1>
    <div class="d-inline-flex">
        <p class="m-0 text-white"><a href="/homeUser">Beranda</a></p>
        <p class="m-0 px-2 text-white">-</p>
        <p class="m-0 text-white">Keranjang Belanja</p>
    </div>
</div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Keranjang</span></h2>
    </div>
<div class="row px-xl-5">
    <div class="col-lg-8 table-responsive mb-5">
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-secondary text-dark">
                <tr>
                    <th>Snack</th>
                    <th>Harga</th>
                    <th>Jumlah Pesan</th>
                    <th>Subtotal</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @php $no = 1; $total = 0; $checkout = ''; $belanja = ''; @endphp
                @if(session('cart'))
                @foreach(session('cart') as $items)
                @if(Auth::user()->id == $items['id_pelanggan'])
                @php $total += $items['harga'] * $items['qty'] @endphp

                <!-- @php $checkout = '<a href="/checkout" class="btn btn-block btn-primary my-3 py-3"><i class="fas fa-money-bill-alt"></i> Lanjutkan Pesan</a>' @endphp -->
                @php $checkout = '<button type="submit" class="btn btn-block btn-primary my-3 py-3" id="checkout-btn" onClick="checkout(event, '.$loop->index.')"><i class="fas fa-money-bill-alt"></i> Lanjutkan Pesan</button>' @endphp
                @php $belanja = '<a href="/shopUser" class="btn btn-block btn-primary my-3 py-3"><i class="fas fa-shopping-cart"></i> Belanja Lagi</a>' @endphp

                <form id="form-{{ $loop->index }}">
                    @csrf
                    <input type="hidden" name="id_snack" value="{{ $items['id_snack'] }}">
                <tr>
                    <td class="align-middle">
                        <img src="/fotoSnack/{{ $items['gambar'] }}" alt="" style="width: 50px;">
                        {{ $items['nama_snack'] }}
                    </td>
                    <td class="align-middle">Rp. {{ number_format($items['harga']) }}</td>
                    <td class="align-middle">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" name="qty" class="form-control bg-secondary text-center" value="{{ $items['qty'] }}">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                            <!-- (minim 20 pcs) -->
                        </div>
                    </td>
 
                    <td class="align-middle">Rp. {{ number_format($items['harga'] * $items['qty']) }}</td>
                    <td class="align-middle">
                        <!-- <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-sync-alt"></i> </button> -->
                        <a onclick="return confirm('Hapus Data Ini ?');" href="/keranjang/deleteCart/{{ $items['id_snack'] }}" class="btn btn-sm btn-primary"><i class="fa fa-times"></i> </a>
                    </td>
                </tr>
                </form>
                @endif
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-lg-4">
        <div class="card border-secondary mb-5">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Ringkasan </h4>
            </div>
            <div class="card-footer border-secondary bg-transparent">
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">Total</h5>
                    <h5 id="total-price" class="font-weight-bold">
                        Rp. {{ number_format($total) }}
                    </h5>
                </div>
                <hr/>
                @if(session('cart') == null)
                    <a href="/shopUser" on="" class="btn btn-block btn-primary my-3 py-3"><i class="fa fa-shopping-cart"></i> Belanja Dulu</a>
                @else
                    {!! $checkout !!}
                    {!! $belanja !!}
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- Cart End -->

<!-- scripts checkout setelah update -->
<script>
    function checkout(event, indexlength) {
        // Get the form element
        const form = document.querySelector("form");
        console.log("form : " + JSON.stringify(form));

        for (let index = 0; index <= indexlength; index++) {
            // const element = array[index];
            
            const form2 = document.getElementById("form-"+index);
    
            // Get the form data
            const formData = new FormData(form2);
            console.log("formData : " + JSON.stringify(formData));
    
            // Create an object to store the form data
            const data = {};
            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }
    
            // Send the form data to the controller
            fetch("/keranjang/updateCart", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                // Handle the response from the controller
                // You can redirect to the checkout page here if needed
               
            })
            .catch(error => {
                // Handle any errors
                console.error(error);
            });
        }
        window.location.href = "/checkout";
    }

</script>

<!-- script addeventlisteners -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const btnMinus = document.querySelectorAll('.btn-minus');
  const btnPlus = document.querySelectorAll('.btn-plus');
  const inputQty = document.querySelectorAll('.quantity input');

  btnMinus.forEach(function(btn) {
    btn.addEventListener('click', function() {
      const input = this.parentNode.nextElementSibling;
      let qty = parseInt(input.value);
      if (qty > 1) {
        qty-1;
        input.value = qty;
        updateSubtotal(input);
        updateTotalPrice();
      }
    });
  });

  btnPlus.forEach(function(btn) {
    btn.addEventListener('click', function() {
      const input = this.parentNode.previousElementSibling;
      let qty = parseInt(input.value);
      qty+1;
      input.value = qty;
      updateSubtotal(input);
      updateTotalPrice();
    });
  });

  inputQty.forEach(function(input) {
    input.addEventListener('change', function() {
      updateSubtotal(input);
      updateTotalPrice();
    });
  });

  function updateSubtotal(input) {
    const row = input.parentNode.parentNode.parentNode;
    const price = row.querySelector('td:nth-child(2)').textContent;
    const subtotal = row.querySelector('td:nth-child(4)');
    const qty = parseInt(input.value);
    const priceNumeric = parseInt(price.replace(/\D/g, ''));
    const subtotalNumeric = qty * priceNumeric;
    subtotal.textContent = 'Rp. ' + numberWithCommas(subtotalNumeric);
  }

  function updateTotalPrice() {
    const subtotals = document.querySelectorAll('td:nth-child(4)');
    let total = 0;
    subtotals.forEach(function(subtotal) {
      const subtotalNumeric = parseInt(subtotal.textContent.replace(/\D/g, ''));
      total += subtotalNumeric;
    });
    document.getElementById('total-price').textContent = 'Rp. ' + numberWithCommas(total);
  }

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }
});
</script>


@endsection