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


async function kodFeltoltes(){
    let Name = document.getElementById('nevInput').value;
    let categoryId = parseInt(document.getElementById('katInput').value);
    let Price = document.getElementById('arInput').value;
    if(Name == "" || categoryId == "" || Price == "")
    {
        alert('Hiányzó adatok');
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
          
         
            alert('Sikeres kódfeltöltés');
           
            window.location.replace("http://localhost/vizsgaremek/src/web/home.php");
        
        }
        
        
    }
    catch(error){
        console.error(error);
    }
}


document.getElementById('uploadBtn').addEventListener('click', kodFeltoltes);
window.addEventListener('load',fetchCategories);