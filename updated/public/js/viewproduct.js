let qty = document.querySelector(".qty");

const incQty = () => {
  qty.innerText = parseInt(qty.innerHTML) + 1;
};

const decQty = () => {
  if (qty.innerHTML != 1) {
    qty.innerText = parseInt(qty.innerHTML) - 1;
  }
};

cart = getCart();

$('.add-to-cart').click( function() {
  let productId = $(this).attr('data-id');
  let price = parseInt($('.discounted-price span').text());
  let size = $('#size').val();
  let colour = $('input[name="colour"]:checked').val();
  let discount = $(this).attr('data-discount');
  let quantity = parseInt($('.qty').text());
  let imgUrl = $('.product-detail-container img')
    .attr("src")
    .split("/")
    .slice(1)
    .join("/");

  addToCart({ productId, size, colour, price, discount, quantity, imgUrl});
} );
