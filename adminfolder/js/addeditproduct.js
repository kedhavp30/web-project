$(document).ready(function () {
  // Initialize stockLevel for a particular size and colour
  let inventory = JSON.parse(localStorage.getItem("inventory"));
  let [size, colour] = Object.keys(inventory)[0].split("-");

  // Select colour
  $('input:radio[name="colour"]')
    .filter(`[value=${colour}]`)
    .attr("checked", true);

  // Select colour
  $('#size').val(`${size}`).change(); 

  $("#stock").val(inventory[Object.keys(inventory)[0]]);
});

// Selecting size; update stockLevel
$("#size").change(function () {
  let colour = $('input[name="colour"]:checked').val();
  let size = $("#size").val();
  let stockLevel = inventory[`${size}-${colour}`];

  if (stockLevel == undefined) {
    alert(`There is no colour ${colour} for this product`);
    $("#stock").val("");
    return;
  }

  $("#stock").val(stockLevel);
});

// Selecting colour; update stockLevel
$('input[name="colour"]').click(function () {
  let colour = $('input[name="colour"]:checked').val();
  let size = $("#size").val();
  let stockLevel = inventory[`${size}-${colour}`];

  if (stockLevel == undefined) {
    alert(`There is no colour ${colour} for this product`);
    $("#stock").val("");
    return;
  }

  $("#stock").val(stockLevel);
});

$("button.btn-save").click(function () {
  let action = $(this).attr("data-action");

  let id = $(this).attr("data-updateId");
  let name = $("#name").val();
  let desc = $("#desc").val();
  let categoryId = $("#category").val();
  let colour = $('input[name="colour"]:checked').val();
  let size = $("#size").val();
  let stockLevel = $("#stock").val();
  let unitPrice = $("#unitPrice").val();
  let discount = $("#discount").val();
  let imgUrl = $("#imgUrl").val();

  $.ajax({
    url: `../updated/api/product/${action}.php`,
    data: JSON.stringify({
      productId: id,
      prodName: name,
      prodDesc: desc,
      unitPrice: unitPrice,
      discount: discount,
      imgUrl: imgUrl,
      categoryId: categoryId,
      colour: colour,
      size: size,
      stockLevel: stockLevel,
    }),
    contentType: "application/json",
    cache: false,
    method: "POST",
    success: (response) => {
      alert(JSON.stringify(response.message));
    },
  });
});
