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