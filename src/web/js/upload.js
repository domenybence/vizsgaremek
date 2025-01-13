async function kodFeltoltes(){
    let Name = document.getElementById('nevInput').value;
    let categoryId = document.getElementById('katInput');
    let Price = document.getElementById('arInput').value;
    try{
        const response = await fetch("./upload.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                userid: 1,
                categoryid: categoryId,
                name: Name,
                price: Price,
                

            })
        });
        if(!response.ok){
            throw new Error(response.status, response.statusText);
        }
        
        
    }
    catch(error){
        console.error(error);
    }
}


document.getElementById('uploadBtn').addEventListener('click', kodFeltoltes);