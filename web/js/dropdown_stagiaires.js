document.addEventListener("DOMContentLoaded", function () {
  // Écouteur d'événement pour le changement de l'organisation
  var organisationDropdown = document.getElementById("organisation_id");
  organisationDropdown.addEventListener("change", function () {
    var organisationId = this.value;
    var sessionId = document.getElementById(
      "sessionstagiaire-session_id"
    ).value;

    // Requête fetch pour charger les stagiaires
    fetch(
      "/session-stagiaire/charger-stagiaires?organisationId=" +
        organisationId +
        "&sessionId=" +
        sessionId
    )
      .then(function (response) {
        return response.text();
      })
      .then(function (data) {
        document.getElementById("stagiaire-container").innerHTML = data;
      })
      .catch(function (error) {
        console.error("Erreur lors du chargement des stagiaires:", error);
      });
  });

  //délégation d'événements pour le clic sur le bouton "Cocher Tout"
  document.body.addEventListener("click", function (event) {
    var target = event.target;

    // Vérifier si le clic est sur le bouton "Cocher Tout"
    if (target.id === "cocherToutBtn") {
      // Basculer entre cocher et décocher toutes les cases
      var checkboxes = document.querySelectorAll("input[type='checkbox']");
      checkboxes.forEach(function (checkbox) {
        checkbox.checked = !checkbox.checked;
      });

      // Mettre à jour le texte du bouton en conséquence
      cocherToutBtn.textContent = checkboxes[0].checked
        ? "Décocher Tout"
        : "Cocher Tout";
    }
  });
});
