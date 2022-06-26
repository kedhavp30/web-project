const createFooter = () => {
  let footer = document.querySelector('footer');

  footer.innerHTML = /* html */ `
    <p>2022 StylishWear All rights reserved</p>
    <p class="icons">
      <i class="fa-brands fa-facebook-f"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-twitter"></i>
    </p>
  `;
}; 

createFooter();