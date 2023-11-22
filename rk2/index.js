function goBack() {
    window.history.back();
}

document.addEventListener('DOMContentLoaded', function () {
    const productButtons = document.querySelectorAll('.view-details');

    productButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.closest('.product').getAttribute('data-product-id');
            window.location.href = 'product_details.php?id=' + productId;
        });
    });
});

