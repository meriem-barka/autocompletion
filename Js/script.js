document.addEventListener("DOMContentLoaded", function () {
  // Les variables
  let input = document.querySelector("input");
  let searchResult = document.querySelector("#searchResult");
  let form = document.querySelector("form");
  let searchSuggestion = document.querySelector("#searchSuggestion");

  input.addEventListener("keyup", function () {
    if (input.value.length > 0) {
      let data = new FormData(form);
      let ul = document.createElement("ul");

      //fetch des données pour la recherche
      fetch("Models/StateModel.php", {
        method: "POST",
        body: data,
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (responseData) {
          if (responseData[0]) {
            // searchResult.innerHTML = "";
            ulbreak = searchResult.querySelector("ul");
            ulbreak !== null ? ulbreak.remove() : null;

            responseData.forEach((element) => {
              console.log(element.name);

              let list = document.createElement("li");
              list.innerHTML = element.name;
              ul.appendChild(list);

              list.addEventListener("click", function () {
                input.value = element.name;

                (window.location.href = `recherche.php?search=${element.name}`)

              });
            });
            searchResult.appendChild(ul);
          }
        });
    } else {
      ulbreak = searchResult.querySelector("ul");
      ulbreak !== null ? ulbreak.remove() : null;
      // window.location.href = "index.php";
    }
  });




  input.addEventListener("input", function () {
    if (input.value.length > 0) {
      let dataSuggestion = new FormData(form);
      let ul = document.createElement("ul");

      //fetch des données pour la recherche
      fetch("Models/StateModel2.php", {
        method: "POST",
        body: dataSuggestion,
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (responseDataSuggestion) {
          if (responseDataSuggestion[0]) {
            searchResult.innerHTML = "";
            searchSuggestion.innerHTML = "";
            ulbreak = searchSuggestion.querySelector("ul");
            ulbreak !== null ? ulbreak.remove() : null;

            responseDataSuggestion.forEach((element) => {
              console.log(element.name);

              let list = document.createElement("li");
              list.innerHTML = element.name;
              ul.appendChild(list);

              list.addEventListener("click", function () {
                input.value = element.name;

                (window.location = `recherche.php?search=${element.name}`);

              });
            });
            searchSuggestion.appendChild(ul);
          } else {
            searchResult.innerHTML =
              "Aucun pays trouvé, voivci quelque propositions";
          }
        });
    } else {
      ulbreak = searchSuggestion.querySelector("ul");
      ulbreak !== null ? ulbreak.remove() : null;
      // window.location.href = "index.php";
    }
  });
});
