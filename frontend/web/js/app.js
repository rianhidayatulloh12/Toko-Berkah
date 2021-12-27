$(function(){
    const $cartJumlah = $('#cart-jumlah');
    const $addToCart = $('.btn-add-to-cart');
    const $itemJumlah = $('.item-jumlah');
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

    $itemJumlah.change(ev => {
        const $this = $(ev.target);
        let $tr = $this.closest('tr');
        const id = $tr.data('id');
        $.ajax({
            method: 'post',
            url: $tr.data('url'),
            data: {id, jumlah: $this.val()},
            success: function (totalJumlah) {
                $cartJumlah.text(totalJumlah)
            }
        })
    })
});