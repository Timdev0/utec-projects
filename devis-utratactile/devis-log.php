<!-- Montre les erreurs-->
<?php
	ini_set("display_errors", true);
	error_reporting(E_ALL);
?>

<?php include 'server.php'?>

<html>
    <?php $title = "Demande devis";?>
    <!-- include head -->
    <?php include 'head.php'?>

    <body class="bg-my1">
        <?php include 'navbar.php'?>

        <div class="container-fluid">
    <div class ="row">
      <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xs-8 offset-xs-2 bg-my2 form-marg">
        <!-- Select Basic -->
        <form id="regForm" class="form-horizontal" action="sendmail-log.php" method="post" accept-charset="utf-8 ">
          <fieldset>

            <!-- Form Name -->
            <legend class="col-md-12 col-lg-12 col-xs-12 title-devis">Demande de devis - Caisse enregistreuse</legend>
            <!-- Select Basic -->
            <div class="tab">
              <div class="form-group min-h pad-top-form">
                <label class="col-md-4 col-lg-4 col-xs-4 control-label title-form offset-md-1 offset-lg-1" for="domaine">Domaine d'activité</label>
                <div class="container">
                  <div class="row">

                    <div class="col-md-4 col-lg-4 col-xs-4 offset-md-1 offset-lg-1">
                      <div class="radio">
                        <label for="domaine-0">
                          <input name="domaine" id="domaine-0" value="Restauration" checked="checked" type="radio">
                          Restauration
                        </label>
                      </div>
                      <div class="radio">
                        <label for="domaine-1">
                          <input name="domaine" id="domaine-1" value="Boulangerie - Pâtisserie" type="radio">
                          Boulangerie / Pâtisserie
                        </label>
                      </div>
                      <div class="radio">
                        <label for="domaine-2">
                          <input name="domaine" id="domaine-2" value="Hôtellerie - Camping" type="radio">
                          Hôtellerie / Camping
                        </label>
                      </div>
                      <div class="radio">
                        <label for="domaine-3">
                          <input name="domaine" id="domaine-3" value="Épicerie - Supérette - Alimentaire" type="radio">
                          Épicerie/ Supérette / Alimentaire
                        </label>
                      </div>
                      <div class="radio">
                        <label for="domaine-4">
                          <input name="domaine" id="domaine-4" value="Bureau de tabac - Presse" type="radio">
                          Bureau de Tabac / Presse
                        </label>
                      </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-3">
                      <div class="radio">
                        <label for="domaine-5">
                          <input name="domaine" id="domaine-5" value="Beauté - Mode" type="radio">
                          Beauté / Mode
                        </label>
                      </div>
                      <div class="radio">
                        <label for="domaine-6">
                          <input name="domaine" id="domaine-6" value="Fleuriste" type="radio">
                          Fleuriste
                        </label>
                      </div>
                      <div class="radio">
                        <label for="domaine-7">
                          <input name="domaine" id="domaine-7" value="Commerce" type="radio">
                          Commerce
                        </label>
                      </div>
                      <div class="radio">
                        <label for="omaine-8">
                          <input name="domaine" id="domaine-8" value="Autre domaine" type="radio">
                          Autre domaine d'activité
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                      <img src="/devis/assets/img/caisse-enregistreuse.jpg" class="img-responsive img-prop" alt="">
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-align-right little-msg marg-ltab">
                Si vous effectuer une demande de devis cela vous créera un compte sur le site d'Ultratactile.
              </div>
            </div>

            <!-- Multiple Radios -->
            <div class="tab">
              <div class="form-group min-h pad-top-form">
                <label class="col-md-4 col-lg-4 col-xs-4 control-label title-form offset-md-1 offset-lg-1" for="caisses">Nombre de caisses</label>
                <div class="container">
                  <div class="row">
                    <div class="col-md-4 col-lg-4 col-xs-4 offset-md-1 offset-lg-1">
                      <div class="radio">
                        <label for="caisses-0">
                          <input name="caisses" id="caisses-0" value="1" checked="checked" type="radio">
                          1 caisse
                        </label>
                      </div>
                      <div class="radio">
                        <label for="caisses-1">
                          <input name="caisses" id="caisses-1" value="2" type="radio">
                          2 caisses
                        </label>
                      </div>
                      <div class="radio">
                        <label for="caisses-2">
                          <input name="caisses" id="caisses-2" value="3" type="radio">
                          3 caisses
                        </label>
                      </div>
                      <div class="radio">
                        <label for="caisses-3">
                          <input name="caisses" id="caisses-3" value="4" type="radio">
                          4 caisses
                        </label>
                      </div>
                    </div>

                    <div class="col-md-3 col-lg-3 col-xs-3">
                      <div class="radio">
                        <label for="caisses-4">
                          <input name="caisses" id="caisses-4" value="5" type="radio">
                          5 caisses
                        </label>
                      </div>
                      <div class="radio">
                        <label for="caisses-5">
                          <input name="caisses" id="caisses-5" value="6" type="radio">
                          6 caisses
                        </label>
                      </div>
                      <div class="radio">
                        <label for="caisses-6">
                          <input name="caisses" id="caisses-6" value="7" type="radio">
                          7 caisses
                        </label>
                      </div>
                      <div class="radio">
                        <label for="caisses-7">
                          <input name="caisses" id="caisses-7" value="8+" type="radio">
                          8 caisses ou plus
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                      <img src="/devis/assets/img/caisse-enregistreuse.jpg" class="img-responsive img-prop" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Multiple Checkboxes -->
            <div class="tab">
              <div class="form-group min-h pad-top-form">
                <label class="col-md-4 col-lg-4 col-xs-4 control-label title-form offset-md-1 offset-lg-1" for="accessoire">Accessoires</label>
                <div class="container">
                  <div class="row">
                    <div class="col-md-4 col-lg-4 col-xs-4 offset-md-1 offset-lg-1">
                      <div class="checkbox">
                        <label for="accessoire-0">
                          <input name="accessoire[]" id="accessoire-0" value="1" type="checkbox">
                          Accessoire 1
                        </label>
                      </div>
                      <div class="checkbox">
                        <label for="accessoire-1">
                          <input name="accessoire[]" id="accessoire-1" value="2" type="checkbox">
                          Accessoire 2
                        </label>
                      </div>
                      <div class="checkbox">
                        <label for="accessoire-2">
                          <input name="accessoire[]" id="accessoire-2" value="3" type="checkbox">
                          Accessoire 3
                        </label>
                      </div>
                      <div class="checkbox">
                        <label for="accessoire-3">
                          <input name="accessoire[]" id="accessoire-3" value="4" type="checkbox">
                          Accessoire 4
                        </label>
                      </div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-xs-3">
                      <div class="checkbox">
                        <label for="accessoire-4">
                          <input name="accessoire[]" id="accessoire-4" value="5" type="checkbox">
                          Accessoire 5
                        </label>
                      </div>
                      <div class="checkbox">
                        <label for="accessoire-5">
                          <input name="accessoire[]" id="accessoire-5" value="6" type="checkbox">
                          Accessoire 6
                        </label>
                      </div>
                      <div class="checkbox">
                        <label for="accessoire-6">
                          <input name="accessoire[]" id="accessoire-6" value="7" type="checkbox">
                          Accessoire 7
                        </label>
                      </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                      <img src="/devis/assets/img/caisse-enregistreuse.jpg" class="img-responsive img-prop" alt="">
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <!-- Text input-->
            <div class="tab min-h marg-ltab pad-top-form">
              <!-- Multiple Radios (inline) -->
              <div class="container form-group">
                <div class="row appel">
                  <label class="col-md-6 control-label text-align-right appel1" for="appel">Je souhaite être appelé : </label>
                  <div class="col-md-6">
                    <label class="radio-inline" for="appel-0">
                      <input name="appel" id="appel-0" value="Oui" checked="checked" type="radio">
                      Oui
                    </label>
                    <label class="radio-inline" for="appel-1">
                      <input name="appel" id="appel-1" value="Non" type="radio">
                      Non
                    </label>
                  </div>
                </div>
              </div>

              <div class="text-align-right little-msg">
                Les champs marqués d'un * sont obligatoires.
              </div>
            </div>

            <div class="tab">
              <label class="control-label title-form pad-top-form1 align-element" for="accessoire">Captcha obligatoire</label>
              <div class="align-element marg-captcha">
                <div class="g-recaptcha" data-sitekey="6Lc41V0UAAAAADso3oHyazEETKBcXowu5AMHEAuE"></div>
              </div>
            </div>


            <div class="col-md-12 col-lg-12 col-xs-12 align-element prev-next">
              <div>
                <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Précedent</button>
                <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Suivant</button>
              </div>
            </div>

            <div class="col-md-12 col-lg-12 col-xs-12 align-element step-marg">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
            </div>
          </fieldset>
        </form>
      </div>
    </div>

    </body>
</html>

    <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the crurrent tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Envoyer";
      } else {
        document.getElementById("nextBtn").innerHTML = "Suivant";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    </script>