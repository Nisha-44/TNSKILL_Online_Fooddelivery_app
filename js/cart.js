function updateCartCount()
{
    fetch("cart_count.php")
    .then(res => res.text())
    .then(data=>{

        let el = document.getElementById("cart-count");

        if(parseInt(data) > 0){
            el.innerHTML = "(" + data + ")";   // ✅ bracket here
        } else {
            el.innerHTML = "";
        }

    });
}
// Add product to cart
function addItem(id){

    document.getElementById("add-"+id).style.display="none";
    document.getElementById("qtybox-"+id).style.display="flex";

    let qty = document.getElementById("qty-"+id);
    qty.innerHTML = 1;

    fetch("cart.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:"id="+id+"&action=add"
    })
    .then(()=>updateCartCount()); 
}

// Increase product quantity
function increase(id){

    let q = document.getElementById("qty-"+id);

    let c = parseInt(q.innerHTML) + 1;
    q.innerHTML = c;

    fetch("cart.php",{
        method:"POST",
        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },
        body:"id="+id+"&action=increase"
    })
    .then(()=>updateCartCount()); 
}

// Decrease product quantity
function decrease(id){

    let q = document.getElementById("qty-"+id);
    let c = parseInt(q.innerHTML) - 1;

    if(c<=0){

        fetch("cart.php",{
            method:"POST",
            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body:"id="+id+"&action=remove"
        })
        .then(()=>{
            updateCartCount();   
            location.reload();
        });

    }else{

        q.innerHTML = c;

        fetch("cart.php",{
            method:"POST",
            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },
            body:"id="+id+"&action=decrease"
        })
        .then(()=>updateCartCount()); 
}
}