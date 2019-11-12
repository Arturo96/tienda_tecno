let delete_buttons = Array.from(document.getElementsByClassName('delete-button')),
    c = console.log;


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