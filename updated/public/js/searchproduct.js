// Price Slider
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 20;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

// Render product grid
let renderProductGrid = (products) => {
  let productGridContent = "";

  products.forEach( (product) => {
    let discountTag = (product.discount != 0) ? `<span class='discount-tag'>${product.discount}% off</span>` : "";

    productGridContent += /* html */ `
      <div class="col">
        <div class="product-card d-flex flex-column">
          <div class="product-image">
            ${discountTag}
            <a href="viewproduct.php?productId=${product.productId}">
              <img src="img/${product.imgUrl}" alt="" class="card-img-top">
            </a>
          </div>
          <div class="card-body">
            <h5>${product.prodName}</h5>
            <p class="product-short-desc">${product.prodDesc}</p>
            <span class="price">Rs ${product.unitPrice}</span>
          </div>
        </div>
      </div>
    `;
  } );

  $('.product-grid').html(productGridContent);
};

// AJAX request to search products
$('.category-list li').click( function() {
  let queryAttr = $(this).attr('data-id').split(':');
  let category = queryAttr[0];
  let gender = queryAttr[1];

  $.ajax({
    url: `../api/product/read.php?category=${category}&gender=${gender}`,
    cache: false,
    method: "GET",
    success: (response) => {
      if (response.status == "success") {
        // Save search results
        localStorage.setItem("searchResults", JSON.stringify(response.data));
        $(".search-results").html(`Search results for <span>${category}</span>`);
        renderProductGrid(response.data);
      } else {
        $(".search-results").text(response.message);
        $(".product-grid").empty();
      }
    }
  });

  // Keep history of dynamically generated products
  const url = new URL(window.location);
  url.searchParams.set('category', category);
  url.searchParams.set('gender', gender);

  const state = { 'category': category, 'gender': gender };
  window.history.pushState(state, '', url);

} );

// Filter price
$('.filter-btn input').click( function() {
  let minPrice = parseInt($('.range-min').val());
  let maxPrice = parseInt($('.range-max').val());

  let searchProducts = localStorage.getItem("searchResults") ? JSON.parse(localStorage.getItem("searchResults")) : null;

  if (!searchProducts) return;

  let filteredProducts = searchProducts.filter( ( {unitPrice} ) => parseInt(unitPrice) >=minPrice && parseInt(unitPrice) <= maxPrice );

  if (filteredProducts.length == 0) {
    $(".search-results").text("No Product Found");
    $(".product-grid").empty();
    return;
  }

  renderProductGrid(filteredProducts);
} );

// Load previous search results when clicking back/forward button
window.onpopstate = event => {
  if (!event.state) return;

  let category = event.state.category;
  let gender = event.state.gender;

  $.ajax({
    url: `../api/product/read.php?category=${category}&gender=${gender}`,
    cache: false,
    method: "GET",
    success: (response) => {
      if (response.status == "success") {
        // Save search results
        localStorage.setItem("searchResults", JSON.stringify(response.data));
        $(".search-results").html(`Search results for <span>${category}</span>`);
        renderProductGrid(response.data);
      } else {
        $(".search-results").text(response.message);
        $(".product-grid").empty();
      }
    }
  });
};