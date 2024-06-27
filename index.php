<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Developer" content="Aimad Hadiri">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prédire l'Etat de Votre Startup</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center font-weight-bold">Prédire l'Etat de Votre Startup</h1>
        <p class="text-center">Cette application vous aide à prédire le succès ou l'échec de votre startup en fonction de diverses informations que vous fournissez.</p>
        
        <form id="predictionForm">
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select class="form-control" id="categorie" name="categorie">
                    <option>Analytics</option>
                    <option>Design</option>
                    <option>Education</option>
                    <option>Entertainment</option>
                    <option>Finances</option>
                    <option>Food & Beverage</option>
                    <option>Health</option>
                    <option>Marketing</option>
                    <option>Music</option>
                    <option>Productivity</option>
                    <option>Services</option>
                    <option>Social Media</option>
                    <option>Software & Hardware</option>
                    <option>Transportation</option>
                    <option>Travel</option>
                    <option>e-Commerce</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pays">Pays</label>
                <select class="form-control" id="pays" name="pays">
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Australia">Australia</option>
                <option value="Belgium">Belgium</option>
                <option value="Brazil">Brazil</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Dubai">Dubai</option>
                <option value="Estonia">Estonia</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="Greece">Greece</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Latvia">Latvia</option>
                <option value="Macedonia">Macedonia</option>
                <option value="Mexico">Mexico</option>
                <option value="Netherlands">Netherlands</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Philippines">Philippines</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Remote">Remote</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Scotland">Scotland</option>
                <option value="Serbia">Serbia</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Spain">Spain</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Thailand">Thailand</option>
                <option value="The Netherlands">The Netherlands</option>
                <option value="Turkey">Turkey</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
                <option value="Vietnam">Vietnam</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ouverture">Année d'ouverture</label>
                <input type="number" class="form-control" id="ouverture" name="ouverture" max="2023" required>
            </div>

            <div class="form-group">
                <label for="fermeture">Année de fermeture (si applicable)</label>
                <input type="number" class="form-control" id="fermeture" name="fermeture">
            </div>

            <div class="form-group">
                <label for="nombre_de_fondateur">Nombre de fondateurs</label>
                <input type="number" class="form-control" id="nombre_de_fondateur" name="nombre_de_fondateur" required>
            </div>

            <div class="form-group">
                <label for="nombre_d_employe">Nombre d'employés</label>
                <input type="number" class="form-control" id="nombre_d_employe" name="nombre_d_employe" required>
            </div>

            <div class="form-group">
                <label for="founding_round">Nombre de tours de financement</label>
                <input type="number" class="form-control" id="founding_round" name="founding_round" required>
            </div>

            <div class="form-group">
                <label for="Total_funding">Financement total (en $)</label>
                <input type="number" class="form-control" id="Total_funding" name="Total_funding" required>
            </div>

            <div class="form-group">
                <label for="Profit">Profit (en $)</label>
                <input type="number" class="form-control" id="Profit" name="Profit" required>
            </div>

            <div class="form-group">
                <label for="nombre_d_investisseur">Nombre d'investisseurs</label>
                <input type="number" class="form-control" id="nombre_d_investisseur" name="nombre_d_investisseur" required>
            </div>

            <button type="button" class="btn btn-primary" onclick="predict()">Voir état</button>
        </form>

        <div id="result" class="mt-5"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function predict() {
            var formData = {
                categorie: $('#categorie').val(),
                pays: $('#pays').val(),
                ouverture: $('#ouverture').val(),
                fermeture: $('#fermeture').val(),
                nombre_de_fondateur: $('#nombre_de_fondateur').val(),
                nombre_d_employe: $('#nombre_d_employe').val(),
                founding_round: $('#founding_round').val(),
                Total_funding: $('#Total_funding').val(),
                Profit: $('#Profit').val(),
                nombre_d_investisseur: $('#nombre_d_investisseur').val()
            };

            $.ajax({
                url: 'http://localhost:5000/predict',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(response) {
                    $('#result').html('<h3>Résultat: ' + response.success + '</h3><p>Raison: ' + response.reason + '</p>');
                },
                error: function(xhr, status, error) {
                    console.error('Erreur:', error);
                }
            });
        }
    </script>
</body>
</html>
