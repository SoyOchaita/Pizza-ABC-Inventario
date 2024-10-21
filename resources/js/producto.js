document.addEventListener('DOMContentLoaded', function () {
    // Delegación de eventos para botones 'Ver más'
    document.body.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-ver-mas')) {
            const productId = event.target.dataset.productId;
            fetch(`/productos/${productId}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('product-detail').innerHTML = data;
                    // Re-iniciar lógica de incremento/decremento para el nuevo contenido
                    initQuantityLogic();
                })
                .catch(error => {
                    console.error('Error al cargar los detalles del producto:', error);
                });
        }
    });
});

// Función para inicializar la lógica de cantidad y precio
function initQuantityLogic() {
    let quantityInput = document.getElementById('quantity');
    let priceElement = document.getElementById('product-price');
    let totalPriceElement = document.getElementById('total-price');
    let increaseBtn = document.getElementById('increase-btn');
    let decreaseBtn = document.getElementById('decrease-btn');

    let price = parseFloat(priceElement.textContent.replace('Q', ''));

    function updateTotalPrice() {
        let quantity = parseInt(quantityInput.value);
        let totalPrice = price * quantity;
        totalPriceElement.innerText = `Q${totalPrice.toFixed(2)}`;
    }

    increaseBtn.addEventListener('click', function () {
        let currentQuantity = parseInt(quantityInput.value);
        quantityInput.value = currentQuantity + 1;
        updateTotalPrice();
    });

    decreaseBtn.addEventListener('click', function () {
        let currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updateTotalPrice();
        }
    });

    quantityInput.addEventListener('input', function () {
        let quantity = parseInt(quantityInput.value);
        if (quantity >= 1) {
            updateTotalPrice();
        } else {
            quantityInput.value = 1;
            updateTotalPrice();
        }
    });
}

// Inicializar la lógica al cargar la página
initQuantityLogic();
