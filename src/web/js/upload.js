async function fetchCategories() {
    try {
      let kat = document.getElementById('katInput');
      const response = await fetch("./kategoriak");
      const data = await response.json();    
      
       for (const kategoria of data) {
        kat.innerHTML += "<option value="+ kategoria.id +">"+ kategoria.nev +"</option>";
       }
    
      
         
      
  }
  catch(error) {
      console.error(error);
      
  }
  }

  function showToast(message, isError = false) {
    const toast = document.getElementById("toast-message");

    if (toast.timeoutId) {
        clearTimeout(toast.timeoutId);
    }

    toast.style.visibility = "visible";
    toast.style.opacity = "1";
    toast.style.display = "block";

    toast.textContent = message;
    toast.className = "toast-message show" + (isError ? " error" : "");

    toast.timeoutId = setTimeout(() => {
        toast.className = "toast-message";

        setTimeout(() => {
            if (!toast.className.includes("show")) {
                toast.style.opacity = "0";
                toast.style.visibility = "hidden";
                toast.textContent = "";
            }
        }, 500);
    }, 3000);
}

async function kodFeltoltes(){
    let Name = document.getElementById('nevInput').value;
    let categoryId = parseInt(document.getElementById('katInput').value);
    let Price = document.getElementById('arInput').value;
    if(Name == "" || categoryId == "" || Price == "")
    {
        showToast('Hiányzó adatok',true);
        return;
    }
    try{
        const response = await fetch("./upload_code.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                categoryid: categoryId,
                name: Name,
                price: Price,
                

            })
        });
        
        if(!response.ok){
            console.log(response.JSON());
            
        }
        else {
          
            alert('Sikeres feltöltés');

            window.location.replace("http://localhost/vizsgaremek/src/web/home.php");
        
        }
        
        
    }
    catch(error){
        console.error(error);
    }
}


document.getElementById('uploadBtn').addEventListener('click', kodFeltoltes);
window.addEventListener('load',fetchCategories);