//filter
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("shop-apply-filters").addEventListener("click", function () {
        let category = document.getElementById("shop-category-filter").value;
        let priceRange = document.getElementById("shop-price-filter").value;
        let sort = document.getElementById("shop-sort-filter").value;

        let formData = new FormData();
        formData.append("category", category);
        formData.append("priceRange", priceRange);
        formData.append("sort", sort);

        fetch("filter_products.php", {
            method: "POST",
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                let productContainer = document.querySelector(".prod-cont");
                productContainer.innerHTML = ""; // Xóa sản phẩm cũ

                if (data.length > 0) {
                    data.forEach(product => {
                        let productHTML = `
                        <div class="prod">
                            <a href="product.php?id=${product.ID}">
                                <img src="${product.ThumbnailImage}" alt="${product.Name}">
                            </a>
                            <div class="des">
                                <h5>${product.Name}</h5>
                                <h4>${new Intl.NumberFormat('vi-VN').format(product.VariantPrice || product.BasePrice)} VNĐ</h4>
                            </div>
                            <a href="product.php?id=${product.ID}"><i class="fa-solid fa-cart-shopping cart"></i></a>
                        </div>
                    `;
                        productContainer.innerHTML += productHTML;
                    });
                } else {
                    productContainer.innerHTML = "<p>Không có sản phẩm nào!</p>";
                }
            })
            .catch(error => console.error("Lỗi tải sản phẩm:", error));
    });
});


document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.querySelector(".search-field");
    let productContainer = document.querySelector(".prod-cont");

    function fetchProducts(query = "") {
        let apiUrl = query.length > 0
            ? "api/search_products.php?q=" + encodeURIComponent(query)
            : "api/get_all_products.php"; // API lấy danh sách sản phẩm mặc định

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                productContainer.innerHTML = ""; // Xóa danh sách cũ

                if (data.length > 0 && !data.error) {
                    data.forEach(product => {
                        let productHTML = `
                            <div class="prod">
                                <a href="product.php?id=${product.ID}">
                                    <img src="${product.ThumbnailImage}" alt="${product.Name}">
                                </a>
                                <div class="des">
                                    <h5>${product.Name}</h5>
                                    <h4>${new Intl.NumberFormat('vi-VN').format(product.VariantPrice)} VNĐ</h4>
                                </div>
                                <a href="product.php?id=${product.ID}">
                                    <i class="fa-solid fa-cart-shopping cart"></i>
                                </a>
                            </div>
                        `;
                        productContainer.innerHTML += productHTML;
                    });
                } else {
                    productContainer.innerHTML = "<p>Không có sản phẩm nào!</p>";
                }
            })
            .catch(error => console.error("Lỗi tìm kiếm:", error));
    }

    searchInput.addEventListener("input", function () {
        let query = searchInput.value.trim();
        fetchProducts(query);
    });

    // Khi load trang, hiển thị danh sách sản phẩm mặc định
    fetchProducts();
});

