function openCart(e){
    e.preventDefault();
    $.ajax({
        url: '/cart/open',
        data: {name: name},
        type: 'GET',
        success: function(res){
            $('#modal .modal-content').html(res);
            $('#modal').modal('show');
        },
        error: function(){
            alert('Error')
        }
    })
}

function clearCart(e){
    e.preventDefault();
    if(confirm('Точно очистить корзину?')){
        $.ajax({
            url: '/cart/clear',
            data: {name: name},
            type: 'GET',
            success: function(res){
                $('#modal .modal-content').html(res);
                if($('.total-quantity').html()){
                    $('.menu-quantity').html('('+$('.total-quantity').html()+')');
                }
                else {
                    $('.menu-quantity').html('(0)');
                }
            },
            error: function(){
                alert('Error')
            }
        })
    }

}

let fullUrl = window.location.href.split('/');
let url = fullUrl[fullUrl.length - 1];
let navLink = document.querySelectorAll('.nav-link');
let classAssigned = false;
for(let i = 0; i < navLink.length; i ++){
    if(navLink[i].classList.contains('active')){
        navLink[i].classList.remove('active')
    }
    if(navLink[i].getAttribute('data-id') == url){
        navLink[i].classList.add('active');
        classAssigned = true;
    }
}
if(!classAssigned && navLink[0]){
    navLink[0].classList.add('active');
}
$('.modal-content').on('click', '.btn-next', function(e){
    e.preventDefault();
    $.ajax({
        url: '/cart/order',
        type: 'GET',
        success: function(res){
            $('#modal-order .modal-content').html(res);
            $('#modal').modal('hide');
            $('#modal-order').modal('show');
        },
        error: function(){
            alert('Error')
        }
    })
});

$('.product-button__add').on('click', function(e){
    e.preventDefault();
    let name = $(this).data('name');
    console.log('name', name);

    $.ajax({
        url: '/cart/add',
        data: {name: name},
        type: 'GET',
        success: function(res){
           $('#modal .modal-content').html(res);
            $('.menu-quantity').html('('+$('.total-quantity').html()+')');
        },
        error: function(){
            alert('Error')
        }
    })
});

$('.modal-content').on('click', '.btn-close', function(){
    $('#modal').modal('hide');
});

$('.modal-content').on('click', '.delete', function(){
    let id = $(this).data('id');
    console.log('delete', id);
    $.ajax({
        url: '/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function(res){
            $('#modal .modal-content').html(res);
            if($('.total-quantity').html()){
                $('.menu-quantity').html('('+$('.total-quantity').html()+')');
            }
            else {
                $('.menu-quantity').html('(0)');
            }
        },
        error: function(){
            alert('Error')
        }
    })
});
