const createFooter = () => {
    let footer=document.querySelector('footer');

    footer.innerHTML = /* html */ `
    <div class="footer-content">
        <img src="img/logo.jpeg" class = "logo" alt="">
        <div class="footer-ul-container">
            <ul class="category">
                <li class = "category-title"> Men </li>
                <li><a href="searchproduct.php?category=TShirt&gender=men" class="footer-link">T-Shirts</a></li>
                <li><a href="searchproduct.php?category=Hoodie&gender=men" class="footer-link">Hoodies</a></li>
                <li><a href="searchproduct.php?category=Shirt&gender=men" class="footer-link">Shirts</a></li>
                <li><a href="searchproduct.php?category=Jean&gender=men" class="footer-link">Jeans</a></li>
                <li><a href="searchproduct.php?category=Trousers&gender=men" class="footer-link">Trousers</a></li>
                <li><a href="searchproduct.php?category=Shoes&gender=men" class="footer-link">Shoes</a></li>
                <li><a href="searchproduct.php?category=Sportswear&gender=men" class="footer-link">Sportswear</a></li>
                <li><a href="searchproduct.php?category=Jogger&gender=men" class="footer-link">Joggers</a></li>
          </ul>
          <ul class="category">
            <li class = "category-title"> Women </li>
            <li><a href="searchproduct.php?category=Blouse&gender=women" class="footer-link">Blouses</a></li>
            <li><a href="searchproduct.php?category=Sweatshirt&gender=women" class="footer-link">Sweatshirts</a></li>
            <li><a href="searchproduct.php?category=Jean&gender=women" class="footer-link">Jeans</a></li>
            <li><a href="searchproduct.php?category=Trousers&gender=women" class="footer-link">Trousers</a></li>
            <li><a href="searchproduct.php?category=Shoes&gender=women" class="footer-link">Shoes</a></li>
            <li><a href="searchproduct.php?category=Sportswear&gender=women" class="footer-link">Sportswear</a></li>
            <li><a href="searchproduct.php?category=Jogger&gender=women" class="footer-link">Joggers</a></li>
            <li><a href="searchproduct.php?category=Dress&gender=women" class="footer-link">Dresses</a></li>
            <li><a href="searchproduct.php?category=Skirt&gender=women" class="footer-link">Skirts</a></li>
        </ul>
       </div>
    </div>
    <p class = "footer-title">About STYLISHWEAR</p>
    <p class = "info"> STYLISHWEAR, a newly launched online clothing website, knows the 
    fashion industry can be a dirty place, thereby supporting eco-friendly standards. 
    The brand wants the customers to look and feel as clean as possible with its high-quality
     apparel for both men and women including hoodies & sweatshirts, dresses, 
     trousers and the comfiest tees among others. The clothes are made from organic and 
     sustainably grown cotton, biodegradable modal and alpaca fibre and they are all crafted 
     from non-toxic dyes. 
 </p>
    <p class="info">Support E-Mail- stylishwearhelpsupport.com,
        customersupport@clothing.com</p>
    <p class="info">Contact Number - 4244589, 57448899</p>
    <p class="info">Rue Des Forges, Port Louis</p>

    <div class="footer-social-container">
        <div>
            <a href="#" class="social-link">Terms & Services</a>
            <a href="#" class="social-link">Privacy Page</a>
       </div>
       <div>
        <a href="#" class="social-link"><i class="fa fa-instagram" ></i></a>
        <a href="#" class="social-link"><i class="fa fa-facebook" ></i></a>
        <a href="#" class="social-link"><i class="fa fa-twitter" ></i></a>
    </div>
    </div>
    <p class="footer-credit">STYLISHWEAR, Best Apparels Clothing Store</p>
`;
}
createFooter();