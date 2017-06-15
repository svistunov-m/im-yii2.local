/*price range*/

 $('#sl2').slider();

 $('.catalog').dcAccordion({
     speed: 300
 });

var RGBChange = function() {
  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
};
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

//$(function(){

    function showCart(res) {
        $('#cart .modal-body').html(res);
        $('#cart').modal();
    }

    function clearCart() {
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function(res){
                if (!res) alert("Ошибка");
                showCart(res);
            },
            error: function(){
                alert('ERROR');
            }
        });
    }

    // добавляем товары в корзину при помощи аякса
    $('.add-to-cart').on('click', function(e){

        // отменяем дефолтное поведение
        e.preventDefault();

        // если у продукта есть атрибут data-id, то можно его достать таким вот образом
        // и вообще можно объявить люлой дополнительный атрибут через data-{название атрибута}
        var id = $(this).data('id');

        $.ajax({
            url: '/cart/add',
            data: {id: id},
            type: 'GET',
            success: function(res){
                if (!res) alert("Нет такого товарра");
                showCart(res);
            },
            error: function(){
                alert('ERROR');
            }
        });
    });

    // удаляем конкретный товар из корзины
    $('body').on('click', 'a.del-item', function(e){
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: '/cart/del',
            data: {id: id},
            type: 'GET',
            success: function(res) {
                if (!res) alert("Ошибка удаления");
                showCart(res);
            },
            error: function(e) {
                alert('DELETE ERROR');
            }
        });

    });

    // простой показ корзины
    $('a.show_cart').on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: '/cart/show-cart',
            type: 'GET',
            success: function(res) {
                if (!res) alert("Ошибка");
                showCart(res);
            },
            error: function(e) {
                alert('DELETE ERROR');
            }
        });

    });
//});