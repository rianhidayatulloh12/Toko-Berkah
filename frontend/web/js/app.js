$(function(){
    const $cartJumlah = $('#cart-jumlah');
    const $addToCart = $('.btn-add-to-cart');
   $addToCart.click(ev => {
       ev.preventDefault();
       const $this = $(ev.target);
       const id = $this.closest('.item-barang').data('key');
       console.log(id);
       $.ajax({
           method: 'POST',
           url: $this.attr('href'),
           data: {id},
           success: function () {
                console.log(arguments)
               $cartJumlah.text(parseInt($cartJumlah.text() || 0) + 1);
           }
       })
   })
});