
async function kodFeltoltes(){
    let Name = document.getElementById('nevInput').value;
    let categoryId = document.getElementById('katInput').value;
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
                userid: 8,
                categoryid: categoryId,
                name: Name,
                price: Price,
                

            })
        });
        
        if(!response.ok){
            throw new Error(response.status, response.statusText);
            
        }
        else {
          
         
            alert('Sikeres kódfeltöltés');
           
            window.location.replace("http://localhost/13c-varga/vizsgaremek/src/web/home.html");
        
        }
        
        
    }
    catch(error){
        console.error(error);
    }
}


document.getElementById('uploadBtn').addEventListener('click', kodFeltoltes);