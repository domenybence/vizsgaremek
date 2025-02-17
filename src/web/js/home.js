document.addEventListener("DOMContentLoaded", () => {
  const softwareContainer = document.getElementById("szoftverek");

  function $(id) {
    return document.getElementById(id);
  }



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
        displaySoftware(data);
      } else {
        alert("Lekérés sikertelen!");
      }
    } catch (error) {
      console.error(error);
      alert("Lekérés sikertelen!");
    }
  }

  function displaySoftware(data) {
    softwareContainer.innerHTML = "";
    data.forEach(item => {
      let card = `
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card bg-dark text-light mb-3">
            <div class="card-header">${item.kategoria_id}</div>
            <div class="card-body bg-light text-dark">
              <h5 class="card-title">${item.nev}</h5>
              <a href="#" class="btn btn-dark">Megtekintés</a>
            </div>
          </div>
        </div>`;
      softwareContainer.innerHTML += card;
    });
  }

  async function searchSoftware() {
    const query = $("kereso").value.trim().toLowerCase();
    if (!query) return;
    
    let response = await fetch("./osszesszoftver");
    let data = await response.json();
    
    let filteredData = data.filter(item => 
      item.nev.toLowerCase().includes(query) || textCosineSimilarity(query, item.nev) > 0.4
    );
    console.log(filteredData);
    displaySoftware(filteredData);
    $("kereso").value = "";
  }

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

  // Event Listeners
  $("ossz").addEventListener("click", () => fetchSoftware("./osszesszoftver"));
  $("html").addEventListener("click", () => fetchSoftware("./katkereses", { kategoria: 1 }));
  $("css").addEventListener("click", () => fetchSoftware("./katkereses", { kategoria: 2 }));
  $("js").addEventListener("click", () => fetchSoftware("./katkereses", { kategoria: 3 }));
  $("php").addEventListener("click", () => fetchSoftware("./katkereses", { kategoria: 4 }));
  $("cs").addEventListener("click", () => fetchSoftware("./katkereses", { kategoria: 5 }));
  $("keresobtn").addEventListener("click", searchSoftware);

  fetchSoftware("./osszesszoftver"); // Load all software on page load
});
