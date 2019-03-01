function Notify() {
    alert("You added a set meal to your basket");
    Order = {
        starter : document.getElementById("starterIN").value,
        main : document.getElementById("mainIN").value,
        dessert : document.getElementById("dessertIN").value,
        drink : document.getElementById("drinkIN").value
    };
    console.log(Object.values(Order));


}

var Order = {};