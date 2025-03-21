'use strict';



/**
 * add event on element
 */

const addEventOnElem = function (elems, type, callback) {
  if (!elems) {
      console.error("Element không tồn tại!");
      return;
  }
  if (elems.length > 1) {
      elems.forEach(elem => {
          if (elem) elem.addEventListener(type, callback);
      });
  } else {
      if (elems) elems.addEventListener(type, callback);
  }
};




/**
 * navbar toggle
 */

const navTogglers = document.querySelectorAll("[data-nav-toggler]");
const navbar = document.querySelector("[data-navbar]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");
const overlay = document.querySelector("[data-overlay]");

const toggleNavbar = function () {
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
}

addEventOnElem(navTogglers, "click", toggleNavbar);

const closeNavbar = function () {
  navbar.classList.remove("active");
  overlay.classList.remove("active");
}

addEventOnElem(navbarLinks, "click", closeNavbar);



/**
 * header sticky & back top btn active
 */

const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

const headerActive = function () {
  if (window.scrollY > 150) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
}

addEventOnElem(window, "scroll", headerActive);

let lastScrolledPos = 0;

const headerSticky = function () {
  if (lastScrolledPos >= window.scrollY) {
    header.classList.remove("header-hide");
  } else {
    header.classList.add("header-hide");
  }

  lastScrolledPos = window.scrollY;
}

addEventOnElem(window, "scroll", headerSticky);



/**
 * scroll reveal effect
 */

const sections = document.querySelectorAll("[data-section]");
const footer = document.querySelector("footer");

const scrollReveal = function () {
  for (let i = 0; i < sections.length; i++) {
    if (sections[i].getBoundingClientRect().top < window.innerHeight * 0.9) {
      sections[i].classList.add("active");
    }
  }

  // Kiểm tra riêng cho footer để đảm bảo nó luôn có active nếu nằm trong viewport
  if (footer && footer.getBoundingClientRect().top < window.innerHeight) {
    footer.classList.add("active");
  }
}

// Chạy ngay khi trang tải xong
document.addEventListener("DOMContentLoaded", scrollReveal);

// Gán sự kiện scroll
addEventOnElem(window, "scroll", scrollReveal);

/**
 * Chuyển hướng
 */
// Hàm để tạo hiệu ứng loading và chuyển hướng trang
function redirectToProductDetail(productId, productName, productPrice, productImage) {
  if (!productId || !productName || !productPrice || !productImage) {
      console.error("Thông tin sản phẩm không đầy đủ.");
      return;
  }

  // Hiển thị hiệu ứng loading
  document.getElementById("loadingSpinner").style.display = "block";

  // Chuyển hướng đến trang chi tiết sản phẩm với dữ liệu trong URL
  setTimeout(() => {
      window.location.href = `sproduct.html?id=${productId}&name=${encodeURIComponent(productName)}&price=${encodeURIComponent(productPrice)}&image=${encodeURIComponent(productImage)}`;
  }, 1000); // Chờ 1 giây để hiệu ứng loading hiển thị
}

// Thêm sự kiện click cho toàn bộ card sản phẩm
document.querySelectorAll('.shop-card').forEach(card => {
  card.addEventListener('click', function () {
      const productId = card.getAttribute('data-id');
      const productName = card.querySelector('.card-title').textContent;
      const productPrice = card.querySelector('.span').textContent;
      const productImage = card.querySelector('.img-cover').src;

      if (productId) {
          redirectToProductDetail(productId, productName, productPrice, productImage);
      } else {
          console.error("Không tìm thấy ID sản phẩm trong thẻ card.");
      }
  });
});

// sự kiện click
document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các phần tử có class shop-card
  let productCards = document.querySelectorAll(".shop-card");

  productCards.forEach(function (card) {
      card.addEventListener("click", function (event) {
          let productId = card.getAttribute("data-id");
          
          // Kiểm tra nếu click vào các nút (không điều hướng)
          if (event.target.closest(".action-btn")) {
              return; // Dừng lại nếu click vào nút bên trong
          }

          // Chuyển hướng đến product.php với ID sản phẩm
          window.location.href = "product.php?id=" + productId;
      });
  });
});






