let delete_buttons = Array.from(document.getElementsByClassName('delete-button')),
    c = console.log,
    d = document,
    seller_deletes = Array.from(d.getElementsByClassName('seller-delete-button')),
    product_deletes = Array.from(d.getElementsByClassName('product-delete-button')),
    tipoProductoBuy = d.getElementById('tipoProductoBuy'),
    productoBuy = d.getElementById('productoBuy'),
    addProductBuy = d.getElementById('addProductBuy'),
    additionalProducts = d.getElementById('additionalProducts'),
    formBuy = d.getElementById('formBuy'),
    numProductos;


// Función para agregar productos nuevos

const addTemplate = baseElement => {
    let newSelect = '';
    let opciones = Array.from(baseElement);
    opciones.forEach(option => {
        newSelect += option.outerHTML;
    });

    return newSelect;
}, 
    getTipoProductoId = selectTipoProductos => {
        let opciones = Array.from(selectTipoProductos).filter(el => {
            if(el.selected) return el;
        });
        [optionSelected] = opciones;
        let tipo_producto_id = parseInt(optionSelected.value),
            container_idProduct = d.getElementById('container_idProduct');
        
        if(container_idProduct != null) {
            container_idProduct.innerHTML = `<input type="hidden" id="hidden_idProduct" value="${tipo_producto_id}">`;
        }
        location.href = `http://localhost/tienda_tecno/add_buy.php?categoria=${tipo_producto_id}`;
        
    }

// Botones de eliminar

if (delete_buttons != null) {

    delete_buttons.forEach(delete_button => {

        let usuario = delete_button.href.split('id=')[1];

        delete_button.addEventListener('click', e => {

            if (!confirm(`Estás seguro de eliminar el usuario ${usuario} ?`)) {
                e.preventDefault();
            }

        });
    });

}

// Delete de Vendedores

if (seller_deletes != null) {

    let sellers = d.getElementsByClassName('seller-name');

    seller_deletes.forEach((seller_delete, index) => {

        seller_delete.addEventListener('click', e => {

            if (!confirm(`Estás seguro de eliminar el vendedor ${sellers[index].value} ?`)) {
                e.preventDefault();
            }

        });
    });

}

// Delete de Productos

if (product_deletes != null) {

    let products = d.getElementsByClassName('product-name');

    product_deletes.forEach((product_delete, index) => {

        product_delete.addEventListener('click', e => {

            if (!confirm(`Estás seguro de eliminar el producto ${products[index].textContent} ?`)) {
                e.preventDefault();
            }

        });
    });

}

// Botón de agregar producto a la compra

if (addProductBuy != null) {
    let numeroProducto = 2;
    addProductBuy.addEventListener('click', () => {
        if (additionalProducts != null) {
            let newProduct = `<hr>
                            <label>Producto: 
                                <select class="product-buy" name="product-buy${numeroProducto}">
                                        ${addTemplate(productoBuy)}
                                </select>
                            </label>
                            
                            <label>Cantidad:
                              <input name="cantidad${numeroProducto++}" type="number" min='1' >
                            </label>
                            `;

            additionalProducts.innerHTML += newProduct;

            numProductos = d.getElementsByClassName('product-buy').length;
            d.getElementById('numProductos').innerHTML = `<input name="numProductos" type="hidden" value="${numProductos}">`
        }
    });
}