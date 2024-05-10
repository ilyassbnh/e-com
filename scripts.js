document.addEventListener("DOMContentLoaded", function() {
    var priceFilter = document.getElementById("priceFilter");
    var priceDisplay = document.getElementById("priceDisplay");
    
    priceFilter.addEventListener("input", function() {
        var price = priceFilter.value + " MAD";
        priceDisplay.textContent = price;
    });
});
