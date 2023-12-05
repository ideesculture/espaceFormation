$(document).ready(function () {
  document
    .getElementById("organisation_id")
    .addEventListener("change", function () {
      var organisationId = this.value;

      fetch(
        "/session-stagiaire/charger-stagiaires?organisationId=" + organisationId
      )
        .then((response) => response.text())
        .then((data) => {
          document.getElementById("stagiaire-container").innerHTML = data;
        })
        .catch((error) => {
          console.error("Erreur lors du chargement des stagiaires:", error);
        });
    });
});
