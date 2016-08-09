
function nahodnyVyber()
{
     var url = "random-destination.php";
     var httpRequest; 
     if (url != 0)
     {
     if (window.ActiveXObject) 
        {
          httpRequest = new ActiveXObject('random-destination.php');
        }
        else
        {
          httpRequest = new XMLHttpRequest();
        }httpRequest.open("GET", url, true);
        httpRequest.onreadystatechange= function () {processRequest(httpRequest);};
        httpRequest.send(null);
      }
      else
      {
         document.getElementById("mistoZobrazeni").innerHTML = "";
      }
}

function processRequest(httpRequest)
{
  if (httpRequest.readyState == 4)
  {
    if(httpRequest.status == 200)
    {
      var mistoZobrazeni = document.getElementById("mistoZobrazeni");
      mistoZobrazeni.innerHTML = httpRequest.responseText;
    }
    else
    {
        alert("Chyba při načítání stránky"+ httpRequest.status +":"+ httpRequest.statusText);
    }
  }
}



