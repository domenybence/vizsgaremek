function $(id) {
  return document.getElementById(id);
}


var btnContainer = document.getElementById("btncontainer");

var btns = btnContainer.getElementsByClassName("btn btn-default navbar-btn text-white");

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");


    if (current.length > 0) {
      current[0].className = current[0].className.replace(" active", "");
    }

    this.className += " active";
  });
}


async function szoftverekLekerese() {
  try {

    let response = await fetch("./osszesszoftver", {
      method: "GET",
      headers: {
        "Content-Type": "application/json"
      }
    });

    const datas = await response.json();
    if (response.ok) {
      console.log(datas);
      let szoftverek = $('szoftverek');
      szoftverek.innerHTML = "";
      for (const data of datas) {
        let col = document.createElement('col');
        col.classList.add('col-4', 'col-md-6', 'col-sm-12');
        let div1 = document.createElement('div');
        let div2 = document.createElement('div');
        let div3 = document.createElement('div');
        div1.classList.add('card', 'bg-dark', 'text-light', 'pb-3', 'mt-2');
        div2.classList.add('card-header');
        div3.classList.add('card-body', 'bg-light', 'text-dark');
        let h5 = document.createElement('h5');
        let p = document.createElement('p');
        let a = document.createElement('a');
        h5.classList.add('card-title');
        p.classList.add('card-text');
        a.classList.add('btn', 'btn-dark', 'text-light');

        div2.innerHTML = data.kategoria_id;
        h5.innerHTML = data.nev;
        a.innerHTML = "Megtekintés";

        div3.appendChild(h5);
        div3.appendChild(p);
        div3.appendChild(a);
        div1.appendChild(div2);
        div1.appendChild(div3);
        col.appendChild(div1);
        szoftverek.appendChild(col);
      }


    }
    else {
      alert('Lekérés sikertelen!');
    }

  } catch (error) {
    console.log(error);
    alert('Lekérés sikertelen!');
  }

}


async function katLekerese(kat) {
  try {

    let kategoria = {
      "kategoria": kat
    }


    let response = await fetch("./katkereses", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(kategoria)

    })
    const datas = await response.json();
    if (response.ok) {
      console.log(datas);
      let szoftverek = $('szoftverek');
      szoftverek.innerHTML = "";
      for (const data of datas) {
        let col = document.createElement('col');
        col.classList.add('col-12', 'col-md-6', 'col-sm-12');
        let div1 = document.createElement('div');
        let div2 = document.createElement('div');
        let div3 = document.createElement('div');
        div1.classList.add('card', 'bg-dark', 'text-light', 'pb-3', 'mt-2');
        div2.classList.add('card-header');
        div3.classList.add('card-body', 'bg-light', 'text-dark');
        let h5 = document.createElement('h5');
        let p = document.createElement('p');
        let a = document.createElement('a');
        h5.classList.add('card-title');
        p.classList.add('card-text');
        a.classList.add('btn', 'btn-dark', 'text-light');

        div2.innerHTML = data.kategoria_id;
        h5.innerHTML = data.nev;
        a.innerHTML = "Megtekintés";

        div3.appendChild(h5);
        div3.appendChild(p);
        div3.appendChild(a);
        div1.appendChild(div2);
        div1.appendChild(div3);
        col.appendChild(div1);
        szoftverek.appendChild(col);
      }


    }
    else {
      alert('Lekérés sikertelen!');
    }

  } catch (error) {
    console.log(error);
    alert('Lekérés sikertelen!');
  }

}

async function searchLekeres() {
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

  try {
    let searchparam = document.getElementById('kereso').value;
    console.log(searchparam);
    let response = await fetch("./osszesszoftver", {
      method: "GET",
      headers: {
        "Content-Type": "application/json"
      }
    });

    const datas = await response.json();
    if (response.ok) {
      console.log(datas);
      let szoftverek = $('szoftverek');
      szoftverek.innerHTML = "";
      
      for (const data of datas) {
        console.log(textCosineSimilarity(searchparam,data.nev));
       if(textCosineSimilarity(searchparam,data.nev) > 0.4 || (data.nev).includes(searchparam))
       {
        let col = document.createElement('col');
        col.classList.add('col-12', 'col-md-6', 'col-sm-12');
        let div1 = document.createElement('div');
        let div2 = document.createElement('div');
        let div3 = document.createElement('div');
        div1.classList.add('card', 'bg-dark', 'text-light', 'pb-3', 'mt-2');
        div2.classList.add('card-header');
        div3.classList.add('card-body', 'bg-light', 'text-dark');
        let h5 = document.createElement('h5');
        let p = document.createElement('p');
        let a = document.createElement('a');
        h5.classList.add('card-title');
        p.classList.add('card-text');
        a.classList.add('btn', 'btn-dark', 'text-light');

        div2.innerHTML = data.kategoria_id;
        h5.innerHTML = data.nev;
        a.innerHTML = "Megtekintés";

        div3.appendChild(h5);
        div3.appendChild(p);
        div3.appendChild(a);
        div1.appendChild(div2);
        div1.appendChild(div3);
        col.appendChild(div1);
        szoftverek.appendChild(col);
       }
      }

      $('kereso').value = "";
    }
    else {
      alert('Lekérés sikertelen!');
    }

  } catch (error) {
    console.log(error);
    alert('Lekérés sikertelen!');
  }



}

window.addEventListener('load', szoftverekLekerese);
$('ossz').addEventListener('click', szoftverekLekerese)
$('html').addEventListener('click', function () {
  katLekerese(1)
}, false);
$('css').addEventListener('click', function () {
  katLekerese(2)
}, false);
$('js').addEventListener('click', function () {
  katLekerese(3)
}, false);
$('php').addEventListener('click', function () {
  katLekerese(4)
}, false);
$('cs').addEventListener('click', function () {
  katLekerese(5)
}, false);
$('keresobtn').addEventListener('click', searchLekeres)