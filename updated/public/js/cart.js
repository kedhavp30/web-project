// Open Close Cart
let backdropDOM = document.querySelector('.backdrop');
let cartDOM = document.querySelector('.cart-wrapper');
let openCartBtn = document.querySelector('.cart-icon');
let closeCartBtn = document.querySelector(".cart-heading");

// Cart Content
let cartContainerDOM = document.querySelector('.cart-container');
let numCartItems = document.querySelector(".cart-num-items span");
let numCartItemsIcon = document.querySelector(".cart-item-qty");
let cartContent = document.createElement("div");
let cartBottom = document.createElement("div");

// Open/Close Cart
let toggleCart = () => {
  cartDOM.classList.toggle("active-cart");
  backdropDOM.classList.toggle("active-backdrop");
};

if (openCartBtn) {
  openCartBtn.addEventListener('click', () => {
    toggleCart();
  });
}

if (closeCartBtn) {
  closeCartBtn.addEventListener('click', () => {
    toggleCart(); 
  });
}

let saveCart = (cart) => {
  localStorage.setItem("cart", JSON.stringify(cart));
};

let getCart = () => {
  return localStorage.getItem("cart") ? JSON.parse(localStorage.getItem('cart')) : [];
};

// Initialise Cart UI
let setCartUI = (cart) => {
  if (cart.length < 1) { // Empty Cart
    cartContent.classList.add('empty-cart');
    cartContent.innerHTML = /* html */ `
      <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="150" width="150" xmlns="http://www.w3.org/2000/svg">
        <path d="M832 312H696v-16c0-101.6-82.4-184-184-184s-184 82.4-184 184v16H192c-17.7 0-32 14.3-32 32v536c0 17.7 14.3 32 32 32h640c17.7 0 32-14.3 32-32V344c0-17.7-14.3-32-32-32zm-432-16c0-61.9 50.1-112 112-112s112 50.1 112 112v16H400v-16zm392 544H232V384h96v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h224v88c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8v-88h96v456z"></path>
      </svg>
      <h3>Your shopping cart is empty.</h3>
      <button class="btn-continue" type="button" onclick="toggleCart()">Continue Shopping</button>
    `;
    cartContainerDOM.appendChild(cartContent);

  } else { // Product Container
    cartContent.classList.add('product-container');

    cart.forEach(product => {
      addProductToCartContent(product);
    });
    cartContainerDOM.appendChild(cartContent);

    // Cart Total
    cartBottom.classList.add('cart-bottom');
    cartBottom.innerHTML = /* html */ `
      <div class="d-flex justify-content-between">
        <h3>Subtotal</h3>
        <h3>Rs <span id="total"></span></h3>
      </div>
      <div class="btn-container">
        <button class="btn-checkout" type="button">Checkout</button>
      </div>
    `;
    cartContainerDOM.appendChild(cartBottom);
    setCartValues(cart);
  }
};

// Add Product to Cart Content
let addProductToCartContent = ({productId, size, colour, price, discount, imgUrl, quantity}) => {
  let div = document.createElement("div");
  div.classList.add("product");
  div.setAttribute("id", `div-${productId}-${size}-${colour}`);
  div.innerHTML = /* html */ `
    <img class="cart-product-image" src="img/${imgUrl}" alt="">
    <div class="item-desc">
      <div class="d-flex justify-content-between top">
        <h5>Hoodie</h5>
        <h4>Rs ${price}</h4>
      </div>
      <div class="top">
        <h4><span>Size: ${size}</span><span>Colour: ${colour}</span></h4>
      </div>
      <div class="d-flex justify-content-between bottom">
        <div>
          <p class="quantity-desc">
            <span class="minus qty-dec" onclick="cartItemQtyDec(${productId}, '${size}', '${colour}')">
              <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path d="M872 474H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h720c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
              </svg>
            </span>
            <span class="num item-qty" id="qty-${productId}-${size}-${colour}">${quantity}</span>
            <span class="plus qty-inc" onclick="cartItemQtyInc(${productId}, '${size}', '${colour}')">
              <svg stroke="currentColor" fill="currentColor" stroke-width="0" t="1551322312294" viewBox="0 0 1024 1024" version="1.1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path><path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
              </svg>
            </span>
          </p>
        </div>
        <button class="remove-item" type="button" onclick="cartItemRemove(${productId}, '${size}', '${colour}')">
          <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.2" baseProfile="tiny" viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3c-4.963 0-9 4.038-9 9s4.037 9 9 9 9-4.038 9-9-4.037-9-9-9zm0 16c-3.859 0-7-3.14-7-7s3.141-7 7-7 7 3.14 7 7-3.141 7-7 7zM12.707 12l2.646-2.646c.194-.194.194-.512 0-.707-.195-.194-.513-.194-.707 0l-2.646 2.646-2.646-2.647c-.195-.194-.513-.194-.707 0-.195.195-.195.513 0 .707l2.646 2.647-2.646 2.646c-.195.195-.195.513 0 .707.097.098.225.147.353.147s.256-.049.354-.146l2.646-2.647 2.646 2.646c.098.098.226.147.354.147s.256-.049.354-.146c.194-.194.194-.512 0-.707l-2.647-2.647z"></path>
          </svg>
        </button>
      </div>
    </div>
  `;
  cartContent.appendChild(div);
};

// Set cart Total and Number of Products in Cart
let setCartValues = (cart) => {
  let total = 0;
  let numOfProducts = 0;

  cart.forEach((product) => {
    total += (product.price * product.quantity);
    numOfProducts += product.quantity;
  });

  numCartItems.innerText = numCartItemsIcon.innerText = numOfProducts;
  document.querySelector('#total').innerText = total;
};



// Initialise Cart
let cart = getCart();
setCartUI(cart);


// Edit Product Quantity in Cart
let cartItemQtyInc = (productId, size, colour) => {
  let index = cart.findIndex((product) =>
    product.productId == productId &&
    product.size == size &&
    product.colour == colour
  );

  let itemQty = document.getElementById(
    `qty-${productId}-${size}-${colour}`
  );

  itemQty.innerText = ++cart[index].quantity;
  setCartValues(cart);
  saveCart(cart);
};

let cartItemQtyDec = (productId, size, colour) => {
  let index = cart.findIndex(
    (product) =>
      product.productId == productId &&
      product.size == size &&
      product.colour == colour
  );

  let itemQty = document.getElementById(
    `qty-${productId}-${size}-${colour}`
  );

  if (cart[index].quantity != 1) {
    itemQty.innerText = --cart[index].quantity;
    setCartValues(cart);
    saveCart(cart);
  }
};

let cartItemRemove = (productId, size, colour) => {
  cart = cart.filter((product) =>
    !(
      product.productId == productId &&
      product.size == size &&
      product.colour == colour
    )
  );

  let productDivDOM = document.getElementById(`div-${productId}-${size}-${colour}`);
  cartContent.removeChild(productDivDOM);
  setCartValues(cart);
  saveCart(cart);

  // Show Empty Cart
  if (cart.length < 1) {
    cartContainerDOM.removeChild(cartBottom);
    cartContent.classList.remove("product-container");
    setCartUI(cart);
  }
};

let addToCart = (product) => {
  if (cart.length < 1) {
    cartContent.classList.remove("empty-cart");
    cartContent.innerHTML = "";
    cart = [...cart, product];
    setCartUI(cart);
  } else {
    let index = cart.findIndex(
      (cartProduct) =>
        cartProduct.productId == product.productId &&
        cartProduct.size == product.size &&
        cartProduct.colour == product.colour
    );

    if (index == -1) {
      cart = [...cart, product];
      addProductToCartContent(product);
    } else {
      cart[index].quantity += product.quantity;
      document.getElementById(`qty-${product.productId}-${product.size}-${product.colour}`).innerText = cart[index].quantity;
    }

    setCartValues(cart);
  }
  saveCart(cart);
};