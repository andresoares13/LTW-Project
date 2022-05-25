function attachBuyEvents() {
    const buttons=document.querySelectorAll("#products button");
    for (const button of buttons){
        button.addEventListener("click",function(){
          let exists=false;
          let total=0;
          const table=document.querySelector("#cart table");
          const tbody=document.querySelector("#cart table tbody");
          const tr=document.createElement("tr");
          const th1=document.createElement("th");
          const th2=document.createElement("th");
          const th3=document.createElement("th");
          const th4=document.createElement("th");
          const th5=document.createElement("th");
          const th6=document.createElement("th");
          tr.setAttribute("id",button.parentElement.getAttribute("data-id"));
          tbody.setAttribute("id","tbody");
          th1.textContent=button.parentElement.getAttribute("data-id");
          th2.textContent=button.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerHTML;
          th3.textContent=button.previousElementSibling.value;
          th3.setAttribute("id","quantity")
          th4.textContent=button.previousElementSibling.previousElementSibling.innerHTML;
          th4.setAttribute("id","price")
          total+=parseInt(button.previousElementSibling.value)*parseInt(button.previousElementSibling.previousElementSibling.innerHTML);
          th5.textContent=total;
          const disPlaytotal=document.querySelector("#cart table tfoot tr th").nextElementSibling;
          disPlaytotal.innerHTML=parseInt(disPlaytotal.innerHTML)+total;
          let deletefunction = 'DeleteRow('+ button.parentElement.getAttribute("data-id") + ')';
          th6.innerHTML='<input type = "button" onclick =' + deletefunction + ' value = "X">';
          const children=tbody.children;
          let samechild;
          for (const child of children){
            if (child.getAttribute("id")==button.parentElement.getAttribute("data-id")){
              exists=true;
              samechild=child;
              break;
            };
          }
          if (!exists){
            tr.appendChild(th1);
            tr.appendChild(th2);
            tr.appendChild(th3);
            tr.appendChild(th4);
            tr.appendChild(th5);
            tr.appendChild(th6);
          }
          else{
            newChildren=samechild.firstChild;
            newChildren.nextElementSibling.nextElementSibling.innerHTML=parseInt(th3.textContent)+parseInt(newChildren.nextElementSibling.nextElementSibling.innerHTML);
            newChildren.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML=parseInt(th5.textContent)+parseInt(newChildren.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML);

          }
          tbody.appendChild(tr);
          

          let data = {id: button.parentElement.getAttribute("data-id"), quantity: button.previousElementSibling.value, price: button.previousElementSibling.previousElementSibling.innerHTML};
          (async () => {
            const rawResponse = await fetch('../action/api.updateCart.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: encodeForAjax(data)
            });
          
          })();

        });
    }
  }
attachBuyEvents();

function DeleteRow(id){

  
  const tbody=document.querySelector("#cart table tbody");

  const children=tbody.children;
  for (const child of children){
    if (child.getAttribute("id")==id){
      const price=child.querySelector("#price").textContent;
      const quantity = child.querySelector("#quantity").textContent;
      const total = parseInt(price)* parseInt(quantity);
      const disPlaytotal=document.querySelector("#cart table tfoot tr th").nextElementSibling;
      disPlaytotal.innerHTML=parseInt(disPlaytotal.innerHTML)-total;     
      child.remove();
      break;
    }; 
  }
  
  let data = {delete: id};
          (async () => {
            const rawResponse = await fetch('../action/api.updateCart.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
              },
              body: encodeForAjax(data)
            });
          
          })();
  
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}