let delete_buttons = Array.from(document.getElementsByClassName('delete-button')),
    c = console.log,
    d = document,
    seller_deletes = Array.from(d.getElementsByClassName('seller-delete-button')),
    product_deletes = Array.from(d.getElementsByClassName('product-delete-button'));

if(delete_buttons != null) {

    delete_buttons.forEach(delete_button => {

        let usuario = delete_button.href.split('id=')[1];
    
        delete_button.addEventListener('click', e => {
        
            if(!confirm(`Estás seguro de eliminar el usuario ${usuario} ?`)) {
                e.preventDefault();
            }
    
        });
    });

}

// Delete de Vendedores

if(seller_deletes != null) {

    let sellers = d.getElementsByClassName('seller-name');

    seller_deletes.forEach((seller_delete, index) => {

        seller_delete.addEventListener('click', e => {
        
            if(!confirm(`Estás seguro de eliminar el vendedor ${sellers[index].value} ?`)) {
                e.preventDefault();
            }
    
        });
    });

}

// Delete de Productos

if(product_deletes != null) {

    let products = d.getElementsByClassName('product-name');

    product_deletes.forEach((product_delete, index) => {

        product_delete.addEventListener('click', e => {
        
            if(!confirm(`Estás seguro de eliminar el producto ${products[index].textContent} ?`)) {
                e.preventDefault();
            }
    
        });
    });

}