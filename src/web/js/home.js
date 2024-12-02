function $(id)
{
    return document.getElementById(id);
}


var btnContainer = document.getElementById("btncontainer");

var btns = btnContainer.getElementsByClassName("btn btn-default navbar-btn text-white");

for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");


    if (current.length > 0) {
      current[0].className = current[0].className.replace(" active", "");
    }

    this.className += " active";
  });
}


async function szoftverekLekerese() {
  try {

    let response = await fetch("./osszesszoftver")
      const datas = await response.json();
      if(response.ok)
      {
          console.log(datas);
          let szoftverek = $('szoftverek');
          szoftverek.innerHTML = "";
          for (const data of datas) {
            let col = document.createElement('col');
            col.classList.add('col-4', 'col-md-6', 'col-sm-12');
            let div1 = document.createElement('div');
            let div2 = document.createElement('div');
            let div3 = document.createElement('div');
            div1.classList.add('card' ,'bg-dark', 'text-light', 'pb-3', 'mt-2');
            div2.classList.add('card-header');
            div3.classList.add('card-body', 'bg-light', 'text-dark');
            let h5 = document.createElement('h5');
            let p = document.createElement('p');
            let a = document.createElement('a');
            h5.classList.add('card-title');
            p.classList.add('card-text');
            a.classList.add('btn', 'btn-dark', 'text-light');
             
            div2.innerHTML = data.kategoria_id;
            h5.innerHTML = data.id;
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
      else
      {
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
        "kategoria" : kat     
    }


      let response = await fetch("./katkereses", {
        method : "POST",
        headers : {
          "Content-Type" : "application/json"
        },
        body : JSON.stringify(kategoria)
        
      })
        const datas = await response.json();
        if(response.ok)
        {
            console.log(datas);
            let szoftverek = $('szoftverek');
            szoftverek.innerHTML = "";
            for (const data of datas) {
              let col = document.createElement('col');
              col.classList.add('col-4', 'col-md-6', 'col-sm-12');
              let div1 = document.createElement('div');
              let div2 = document.createElement('div');
              let div3 = document.createElement('div');
              div1.classList.add('card' ,'bg-dark', 'text-light', 'pb-3', 'mt-2');
              div2.classList.add('card-header');
              div3.classList.add('card-body', 'bg-light', 'text-dark');
              let h5 = document.createElement('h5');
              let p = document.createElement('p');
              let a = document.createElement('a');
              h5.classList.add('card-title');
              p.classList.add('card-text');
              a.classList.add('btn', 'btn-dark', 'text-light');
               
              div2.innerHTML = data.kategoria_id;
              h5.innerHTML = data.id;
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
        else
        {
            alert('Lekérés sikertelen!');
        }
        
    } catch (error) {
        console.log(error);
        alert('Lekérés sikertelen!');
    }
   
    }



window.addEventListener('load', szoftverekLekerese);
$('ossz').addEventListener('click', function() {
  szoftverekLekerese
},false);
$('html').addEventListener('click', function() {
  katLekerese(1)
},false);
$('css').addEventListener('click', function() {
  katLekerese(2)
},false);
$('js').addEventListener('click', function() {
  katLekerese(3)
},false);
$('php').addEventListener('click', function() {
  katLekerese(4)
},false);
$('cs').addEventListener('click', function() {
  katLekerese(5)
},false);