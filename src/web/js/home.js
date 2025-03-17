document.addEventListener("DOMContentLoaded", () => {
  const softwareContainer = document.getElementById("szoftverek");
  const paginationContainer = document.createElement("div");
  paginationContainer.classList.add("pagination-container", "mt-3", "d-flex", "justify-content-center");
  softwareContainer.parentNode.appendChild(paginationContainer);
  //Segédvüggvény
  function $(id) {
    return document.getElementById(id);
  }

  let currentPage = 1;
  const itemsPerPage = 9; 
  let softwareData = [];
  //Szoftverek adatbázisból való lekérése
  async function fetchSoftware(endpoint, bodyData = null) {
    try {
      const options = bodyData ? {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(bodyData)
      } : {};
      
      let response = await fetch(endpoint, options);
      let data = await response.json();
      
      if (response.ok) {
        softwareData = data;
        currentPage = 1;
        displaySoftware();
      } else {
        alert("Lekérés sikertelen!");
      }
    } catch (error) {
      console.error(error);
      alert("Lekérés sikertelen!");
    }
  }
  //Szoftverek megjelenítése
  function displaySoftware() {
    softwareContainer.innerHTML = "";
    let start = (currentPage - 1) * itemsPerPage;
    let end = start + itemsPerPage;
    let paginatedItems = softwareData.slice(start, end);

    paginatedItems.forEach((item) => {
      let card = `
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card bg-dark text-light mb-3">
            <div class="card-header">${item.katnev}</div>
            <div class="card-body bg-light text-dark">
              <h5 class="card-title">${item.nev}</h5>
              <a href="./kod/${item.id}" class="btn btn-dark">Megtekintés</a>
            </div>
          </div>
        </div>`;
      softwareContainer.innerHTML += card;
    });

    setupPagination();
  }

  function setupPagination() {
    paginationContainer.innerHTML = "";
    let pageCount = Math.ceil(softwareData.length / itemsPerPage);

    for (let i = 1; i <= pageCount; i++) {
      let btn = document.createElement("button");
      btn.classList.add("btn", "btn-outline-dark", "mx-1");
      btn.textContent = i;
      if (i === currentPage) btn.classList.add("btn-primary");

      btn.addEventListener("click", () => {
        currentPage = i;
        displaySoftware();
      });

      paginationContainer.appendChild(btn);
    }
  }

 
  //Koszinusz szimilaritás
  function wordCountMap(str) {
    let words = str.split(' ');
    let wordCount = {};
    words.forEach((w) => {
      wordCount[w] = (wordCount[w] || 0) + 1;
  
    });
    return wordCount;
  }
  
  function addWordsToDictionary(wordCountmap, dict){
    for(let key in wordCountmap){
        dict[key] = true;
    }
  }
  
  function wordMapToVector(map,dict){
    let wordCountVector = [];
    for (let term in dict){
        wordCountVector.push(map[term] || 0);
    }
    return wordCountVector;
  }
  
  function dotProduct(vecA, vecB){
    let product = 0;
    for(let i=0;i<vecA.length;i++){
        product += vecA[i] * vecB[i];
    }
    return product;
  }
  
  function magnitude(vec){
    let sum = 0;
    for (let i = 0;i<vec.length;i++){
        sum += vec[i] * vec[i];
    }
    return Math.sqrt(sum);
  }
  
  function cosineSimilarity(vecA,vecB){
    return dotProduct(vecA,vecB)/ (magnitude(vecA) * magnitude(vecB));
  }
  
  function textCosineSimilarity(txtA,txtB){
    const wordCountA = wordCountMap(txtA);
    const wordCountB = wordCountMap(txtB);
    let dict = {};
    addWordsToDictionary(wordCountA,dict);
    addWordsToDictionary(wordCountB,dict);
    const vectorA = wordMapToVector(wordCountA,dict);
    const vectorB = wordMapToVector(wordCountB,dict);
    return cosineSimilarity(vectorA, vectorB);
  }

  async function fetchCategories() {
    try {
      let kat = document.getElementById('kategoriak');
      const response = await fetch("./kategoriak");
      const data = await response.json();    
      
       for (const kategoria of data) {
        kat.innerHTML += "<button type='button' id='" + kategoria.id + "' class='btn btn-outline-light katbtn'> " + kategoria.nev + "</button>"
       }
    
      
         
      
  }
  catch(error) {
      console.error(error);
      
  }
  }

  // EventListenerek
 
  const container = document.querySelector('#kategoriak');
  container.addEventListener('click', function (e) {
    if (e.target.classList.contains('katbtn')) {
      fetchSoftware("./katkereses",{kategoria : e.target.id} );
    }
    else
    {
      fetchSoftware("./osszesszoftver")
    }
  });
 

  
  $("keresobtn").addEventListener("click", async () => {
    const query = document.getElementById("kereso").value.trim().toLowerCase();
    if (!query) return;

    let response = await fetch("./osszesszoftver");
    let data = await response.json();

    softwareData = data.filter(
      (item) => item.nev.toLowerCase().includes(query) || textCosineSimilarity(query, item.nev) > 0.4
    );

    currentPage = 1;
    displaySoftware();
    document.getElementById("kereso").value = "";
  });
  
  
  fetchSoftware("./osszesszoftver"); // Összes szoftver betöltése az oldal betöltésekor
  fetchCategories();
});
