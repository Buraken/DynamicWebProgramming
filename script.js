document.addEventListener("DOMContentLoaded", function(e) {
    var addToCartButtons = document.getElementsByClassName('addCart');
    for (var i = 0; i < addToCartButtons.length; i++) {
        var button = addToCartButtons[i];
        button.addEventListener('click', addToCartClicked);
    }

    var removeFromCartButtons = document.getElementsByClassName('book-remove');
    for(var i = 0; i < removeFromCartButtons.length; i++) {
        var button = removeFromCartButtons[i];
        button.addEventListener('click', removeFromCartClicked);
    }

    var bookUnitInCart = document.getElementsByClassName('book-in-cart-unit');
    for(var i = 0; i < bookUnitInCart.length; i++){
        var button = bookUnitInCart[i];
        button.addEventListener('change', changeTotalPrice);
    }

    /*var addBookButton = document.getElementsByClassName('add-book-button')[0];
    addBookButton.addEventListener('click', addBook);*/

    var purchaseButton = document.getElementsByClassName('purchase')[0];
    purchaseButton.addEventListener('click', purchase);

    var purchaseButton = document.getElementsByClassName('purchase2')[0];
    purchaseButton.addEventListener('click', purchase2);
});

function purchase(){
    document.getElementsByClassName('cart-purchase-button')[0].style.display = 'none';
    document.getElementsByClassName('purchase-area')[0].style.display = 'block';
}

/*function purchase2(){
    if(document.getElementsByClassName('address-area')[0].value == ""){
        alert("Adres alanını doldurunuz...")
    } else {
        document.getElementsByClassName('address-area')[0].value = "";
        alert("Siparişiniz hazırlanıyor...")
        document.getElementsByClassName('cart-template')[0].style.display = 'none';
        document.getElementsByClassName('cart-purchase-button')[0].style.display = 'block';
        document.getElementsByClassName('purchase-area')[0].style.display = 'none';
        document.getElementsByClassName('basket')[0].innerHTML = "";
    }
    
}*/

function addBook(){
    var bookImage = document.getElementsByClassName('add-book-image-input')[0].value;
    var bookName = document.getElementsByClassName('add-book-name-input')[0].value;
    var bookAuthor = document.getElementsByClassName('add-book-author-input')[0].value;
    var bookPrice = document.getElementsByClassName('add-book-price-input')[0].value;
    

    if(bookImage == "" || bookName == "" || bookAuthor == "" || bookPrice == ""){
        alert("Tüm alanları doldurmanız zorunludur...");
        return;
    }
    var book = document.createElement('div');
    var addToRow = document.getElementsByClassName('row')[1];
    var addBookInPageContent = `
        <div class="card">
            <div class="bookimage"><img src="${bookImage}" style="width:100%"></div>
            <div class="bookname"><h2>${bookName}</h2></div>
            <div class="authorname"><h3>${bookAuthor}</h3></div>
            <div><p class="price">${bookPrice}</p></div>
            <div><button class="addCart" type="button">Sepete Ekle</button></div>
        </div>
    
    `;
    book.innerHTML = addBookInPageContent;
    addToRow.append(book);
    book.getElementsByClassName('addCart')[0].addEventListener('click',addToCartClicked);
}

function changeTotalPrice(event){
    var input = event.target;
    if(isNaN(input.value) || input.value <=0 ){
        input.value = 1;
    }
    updateCartTotal();
}


function removeFromCartClicked(element){
    var buttonClicked = element.target;
    buttonClicked.parentElement.parentElement.remove();
    updateCartTotal();
    if(document.getElementsByClassName('basket')[0].innerHTML === ""){
        document.getElementsByClassName('cart-template')[0].style.display = 'none';
        document.getElementsByClassName('cart-purchase-button')[0].style.display = 'block';
        document.getElementsByClassName('purchase-area')[0].style.display = 'none';
    }
    cartArrayUpdate();
}

function updateCartTotal(){

    var cart = document.getElementsByClassName('basket')[0];
    var cartItems = cart.getElementsByClassName('book-card-in-cart');
    var total = 0;
    for(var i = 0 ; i < cartItems.length; i++){
        var cartItem = cartItems[i];
        var itemPriceText = cartItem.getElementsByClassName('book-cart-price')[0];
        var itemUnitElement = cartItem.getElementsByClassName('book-in-cart-unit')[0];
        var itemUnitElement2 = itemUnitElement.getElementsByClassName('unit')[0];
        var itemPrice = parseFloat(itemPriceText.innerText.replace('$',''));
        var itemUnit = itemUnitElement2.value;
        total = total + (itemPrice * itemUnit);
    }
    document.getElementsByClassName('cart-total')[0].innerText = '₺' + total;
    document.getElementsByClassName('book_cart_total')[0].value = total; 

}

function addToCartClicked(event){
    document.getElementsByClassName('cart-template')[0].style.display = 'block';
    var button = event.target;
    var cartItem = button.parentElement.parentElement;
    var bookName = cartItem.getElementsByClassName('bookname')[0].innerText;
    var bookPrice = cartItem.getElementsByClassName('price')[0].innerText;
    var bookImage = cartItem.getElementsByClassName('bookimage')[0].getElementsByTagName('img')[0].src;
    var bookId = cartItem.getElementsByClassName('bookid')[0].innerText;
    addToCart(bookName,bookPrice,bookImage,bookId);
    updateCartTotal();

}

function addToCart(bookName,bookPrice,bookImage,bookId){
    
    var bookInCart = document.createElement('div');
    bookInCart.classList.add('book-card-in-cart');
    var booksInCart = document.getElementsByClassName('basket')[0];
    var bookNames = booksInCart.getElementsByClassName('book-cart-name');
    for(var i = 0; i < bookNames.length; i++){
        if(bookNames[i].innerText == bookName){
            var findUnitElement = booksInCart.getElementsByClassName('book-in-cart-unit')[i];
            findUnitElement.getElementsByClassName('unit')[0].value++;
            cartArrayUpdate();
            return;
        }
    }
    var bookInCartContent = `
            <div class="book_cart_id" style="display: none;">${bookId}</div>
            <div class="book-cart-image"><img src="${bookImage}" style="width:100%"></div>
            <div class="book-cart-name">${bookName}</div>
            <div class="book-in-cart-unit"><input class="unit" type="text" id="unit" name="unit" value= "1"></div>
            <div><p class="book-cart-price">${bookPrice}</p></div>
            <div class="book-remove"><button class="removeCart" type="button">X</button></div>`;
    bookInCart.innerHTML = bookInCartContent;
    booksInCart.append(bookInCart);
    bookInCart.getElementsByClassName('removeCart')[0].addEventListener('click',removeFromCartClicked);
    bookInCart.getElementsByClassName('unit')[0].addEventListener('change', updateCartTotal);

    cartArrayUpdate();

    
}

function cartArrayUpdate(){
    var booksInCart = document.getElementsByClassName('basket')[0];
    var bookNames = booksInCart.getElementsByClassName('book-cart-name');
    var bookIds = booksInCart.getElementsByClassName('book_cart_id');
    var bookIdsArray = new Array();
    for(var i = 0; i < bookIds.length; i++) {
        var ids = bookIds[i].innerText;
        bookIdsArray[i] = ids;
    }
    var bookQuantities = booksInCart.getElementsByClassName('unit');
    var bookQuantitiesArrays = new Array();
    for(var i = 0; i < bookQuantities.length; i++) {
        var quantities = bookQuantities[i].value;
        bookQuantitiesArrays[i] = quantities;
    }

    document.getElementsByClassName('book_cart_ds')[0].value = bookIdsArray;
    document.getElementsByClassName('book-cart-quantity')[0].value = bookQuantitiesArrays;
}

