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
      console.log("Lekérés sikertelen!");
    }
  } catch (error) {
    console.error(error);
    console.log("Lekérés sikertelen!");
  }
}
//Szoftverek megjelenítése
function displaySoftware() {
  softwareContainer.innerHTML = "";
  let start = (currentPage - 1) * itemsPerPage;
  let end = start + itemsPerPage;
  let paginatedItems = softwareData.slice(start, end);

  paginatedItems.forEach((item) => {
    if(item.katnev == "C#")
    {
      item.katnev = "CS";
    }
    let card = `
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card-group">
        <div class="card">
          <img src="img/${item.katnev}.jpg" class="card-img-top" alt="${item.nev}"/>
          <div class="card-body">
            <h5 class="card-title">${item.nev}</h5>
            <p class="card-text">
              ${item.katnev}
            </p>
          </div>
          <div class="card-footer">
            <a href="./kod/${item.id}" class="btn btn-dark">Megtekintés</a>
          </div>
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

// EventListenerek
$("keresobtn").addEventListener("click", async () => {
  const query = document.getElementById("kereso").value.trim().toLowerCase();
  if (!query) return;

  let response = await fetch("./konyvtar");
  let data = await response.json();

  softwareData = data.filter(
    (item) => item.nev.toLowerCase().includes(query) || textCosineSimilarity(query, item.nev) > 0.4
  );

  currentPage = 1;
  displaySoftware();
  document.getElementById("kereso").value = "";
});

fetchSoftware("./konyvtar");

});
