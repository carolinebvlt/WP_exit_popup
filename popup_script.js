document.addEventListener("mouseleave", function(){

  var page = document.getElementById('page');
  page.style.opacity = '0.5';
  var box = document.createElement('div');
  document.body.appendChild(box);
  box.setAttribute("id", "popupBox");
  var popupBox = document.getElementById('popupBox');
  popupBox.style.position = "fixed";
  popupBox.style.top = "20vh";
  popupBox.style.left = "10%";
  popupBox.style.width = "80%";
  popupBox.style.height = "60vh";
  popupBox.style.textAlign = "center";
  popupBox.style.backgroundColor = "#f7f7f7";
  popupBox.innerHTML = "<h1 id='titre'>" + popupData.popupTitle +"</h1><div id='description'><p>"+ popupData.popupDescription +"</p></div>"
  + "<a><button onclick='openLink()' type='button'>Click Me</button></a><p id='no'onclick='closePopup()'>Close</p>";
  var no = document.getElementById('no').style.fontSize = "small";
  var title = document.getElementById('titre');
  var desc = document.getElementById('description');
  popupBox.style.display = "flex";
  popupBox.style.flexDirection = "column";
  popupBox.style.justifyContent = "space-around";
  popupBox.style.boxShadow = "silver 5px 10px 20px";
  popupBox.style.border = "solid white 3px";

});

function openLink(){
  closePopup();
  open('https://'+popupData.popupUrl);
}

function closePopup(){
  var todelete = document.getElementById('popupBox');
  document.body.removeChild(todelete);
  page.style.opacity = '1';
}
