<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>RH</title>
  <link rel="stylesheet" href="style/styledata.css">
  <style>
    .container-fluid {
      margin-top: 20px;
    }

    .table-container {
      overflow-y: auto;
    }

    .total-counts {
      background-color: #f8f9fa;
      padding: 10px;
      border: 1px solid #dee2e6;
      margin-bottom: 20px;
    }

    .navbar {
      background-color: #007bff;
    }

    .counter {
      display: inline-block;
      padding: 5px 10px;
      background-color: #e74c3c;
      color: white;
      border-radius: 5px;
      margin-left: 5px;
      font-size: 14px;
    }

    .Connectedas {
      padding: 5px 15px;
      background-color: #0078d7;
      color: white;
      margin-left: 5px;
      font-size: 14px;
    }

    .counterNONE {
      display: inline-block;
      padding: 5px 10px;
      background-color: #017aff;
      color: white;
      border-radius: 5px;
      margin-left: 5px;
      font-size: 14px;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 400px;
      text-align: center;
    }

    button {
      margin: 5px;
      padding: 10px 20px;
      cursor: pointer;
    }

      .button-container {
    display: flex;
    align-items: center; /* Align buttons vertically center */
}

.reject-btn {
    margin-left: 10px; /* Add some space between buttons */
}
  </style>
</head>
<body>

<?php

require_once('db_connection.php');

function getCount($conn, $columnName)
{
    $sql = "SELECT COUNT(*) as countNouveau FROM `wp_tablesome_table_6969` WHERE `column_6` = 'Nouveau'";
    $resultNouveau = $conn->query($sql);

    $countNouveau = 0;

    if ($resultNouveau->num_rows > 0) {
        $rowNouveau = $resultNouveau->fetch_assoc();
        $countNouveau = $rowNouveau['countNouveau'];
    }

    return $countNouveau;
}

function getCountSalaire($conn, $columnName)
{
    $sql = "SELECT COUNT(*) as countNouveau FROM `wp_tablesome_table_6980` WHERE `column_11` = 'Nouveau'";
    $resultNouveau = $conn->query($sql);

    $countNouveauSalaire = 0;

    if ($resultNouveau->num_rows > 0) {
        $rowNouveau = $resultNouveau->fetch_assoc();
        $countNouveauSalaire = $rowNouveau['countNouveau'];
    }

    return $countNouveauSalaire;
}

function getCountTravail($conn, $columnName)
{
    $sql = "SELECT COUNT(*) as countNouveau FROM `wp_tablesome_table_6958` WHERE `column_6` = 'Nouveau'";
    $resultNouveau = $conn->query($sql);

    $countNouveauTravail = 0;

    if ($resultNouveau->num_rows > 0) {
        $rowNouveau = $resultNouveau->fetch_assoc();
        $countNouveauTravail = $rowNouveau['countNouveau'];
    }

    return $countNouveauTravail;
}

function getCountMaj($conn, $columnName)
{
    $sql = "SELECT COUNT(*) as countNouveau FROM `wp_tablesome_table_6925` WHERE `column_13` = 'Nouveau'";
    $resultNouveau = $conn->query($sql);

    $countNouveauTravail = 0;

    if ($resultNouveau->num_rows > 0) {
        $rowNouveau = $resultNouveau->fetch_assoc();
        $countNouveauTravail = $rowNouveau['countNouveau'];
    }

    return $countNouveauTravail;
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">
    </a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <span class="nav-link" style="color: #fff !important;">Connecté en tant que:</span>
        </li>
        <li class="nav-item">
        <span class='Connectedas' id="loggedInUserFullName" style="color: white !important;"></span>
            <a class="nav-link" href="index.php" style="color: #fff !important;">  <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </li>
    </ul>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Retrieve user details from local storage
    var storedUser = localStorage.getItem('loggedInUser');
    
    if(storedUser) {
        // Parse the JSON string back to a JavaScript object 
        var user = JSON.parse(storedUser);
        
        // Display the full name of the connected user in the navbar brand
        var loggedInUserFullName = document.getElementById('loggedInUserFullName');
        loggedInUserFullName.innerText = user.full_name;
    } else {
        // Handle the case where user details are not found in local storage
        alert("User details not found!");
    }
});
</script>


    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="attestationsalaire.php" >
                    Attestations de salaires
                    <?php
                        $countSalaire = getCountSalaire($conn, 'column_11');
                        if ($countSalaire > 0) {
                            echo "<span class='counter'>$countSalaire</span>";
                        } else {
                          echo "<span class='counterNONE'>$countSalaire</span>";

                        }
                    ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="attestationstravail.php" style="color: #fff !important;font-size" >
                    Attestations de travail
                    <?php
                        $countTravail = getCountTravail($conn, 'column_11');
                        if ($countTravail > 0) {
                            echo "<span class='counter'>$countTravail</span>";
                        } else {
                          echo "<span class='counterNONE'>$countTravail</span>";

                        }
                    ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fichedepaie.php" >
                    Fiches de paie
                    <?php
                        $countFiches = getCount($conn, 'column_6');
                        if ($countFiches > 0) {
                            echo "<span class='counter'>$countFiches</span>";
                        } else {
                          echo "<span class='counterNONE'>$countFiches</span>";

                        }
                    ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="demandemaj.php" >
                    Mise à jour coordonnées
                    <?php
                        $countMaj = getCountMaj($conn, 'column_13');
                        if ($countMaj > 0) {
                            echo "<span class='counter'>$countMaj</span>";
                        } else {
                          echo "<span class='counterNONE'>$countMaj</span>";

                        }
                    ?>
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
  <div class="row">
  <div class="col-md-12">
        <br>
        <br>
        <h2>Demandes des attestations de salaires</h2>
<div class="text-right">
  <button class="btn btn-success btn-excel" onclick="exportToExcel()">Export to Excel</button>
</div>
<?php if(isset($_GET['success']) && ($_GET['success'] == '1' || $_GET['success'] == '2')): ?>
  <div class="alert alert-success" role="alert">
    <?php if ($_GET['success'] == '1'): ?>
      Mise à jour réussie!
    <?php elseif ($_GET['success'] == '2'): ?>
      Sms envoyé avec succès!
    <?php endif; ?>
  </div>
<?php endif; ?>
<div class="row">
  <div class="col-md-6">
    <input type="text" id="searchInput" class="form-control" placeholder="Recherche par Nom, Tel...">
  </div>
  <div class="col-md-6">
    <div class="table-container">
      <select id="etatSelect" class="form-control">
        <option value="Tout">Tout</option>
        <option value="Nouveau">Nouveau</option>
        <option value="Rejetée">Rejetée</option>
        <option value="Traité">Traité</option>
      </select>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $('#etatSelect').on('change', function() {
    var selectedEtat = $(this).val().trim();
    if (selectedEtat === 'Tout') {
      $('#dataTable tbody tr').show(); // Show all rows if 'Tout' is selected
    } else {
      $('#dataTable tbody tr').hide(); // Hide all rows initially
      $('#dataTable tbody tr').each(function() {
        if ($(this).find('td:nth-child(9)').text().trim() === selectedEtat) {
          $(this).show(); // Show rows matching the selected état
        }
      });
    }
  });
});
</script>
<br>

        <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th class="sortable-header">Date</th>
            <th class="sortable-header">Nom</th>
            <th class="sortable-header">Tel</th>
            <th class="sortable-header">Choix</th>
            <th class="sortable-header">Source</th>
            <th class="sortable-header">Traitée le</th>
            <th class="sortable-header">Traitée par</th>
            <th  class="sortable-header">État</th>
            <th>Action</th>

        </tr>
    </thead>
    <tbody>
        <?php
        require_once('db_connection.php');
        $records_per_page = 7;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $records_per_page;
        $sql = "SELECT * FROM `wp_tablesome_table_6958` ORDER BY `id` DESC LIMIT $offset, $records_per_page";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $counter = $offset + 1; // Initialize counter
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$counter}</td>"; // Display counter
                echo "<td>{$row['created_at']}</td>"; 
                echo "<td>{$row['column_1']} ( {$row['column_2']} )</td>";  
                echo "<td>{$row['column_3']} <a href='javascript:void(0);' onclick='confirmSendSMS(\"{$row['column_3']}\", \"Votre attestation de travail est prête à être récupérée\")'><img src='Images/sendsms.png' alt='Icon' width='30' height='30'></a></td>";
                echo "<td>";
                if ($row['column_5'] == 'Recevoir la fiche par mail') {
                    echo "<img src='Images/email.png' alt='Icon' width='40' height='40'>Email";
                } else {
                    echo "<img src='Images/paper.png' alt='Icon' width='40' height='40'>Papier";
                }
                echo "</td>";
                echo "<td>";
                if ($row['column_4'] == 'Borne') {
                    echo "<img src='Images/Borne.png' alt='Icon' width='40' height='40'>";
                } else {
                    echo "<img src='Images/intranet.png' alt='Icon' width='40' height='40'>";
                }
                echo "</td>";
                echo "<td>{$row['updated_at']}</td>";
                echo "<td>{$row['column_12']}</td>";
                echo "<td>{$row['column_6']}</td>";  
                echo "<td>";
                if ($row['column_6'] === 'Nouveau') {
                    echo "<div class='button-container'>";
                    echo "<button class='btn btn-primary' onclick='confirmUpdateStatus(
                        {$row['id']},
                        \"{$row['column_3']}\", //noumrou
                        \"{$row['column_6']}\",  // traité
                        \"{$row['column_5']}\" // type de demande
                    )'>Prête</button>";
                    echo "<button class='btn btn-danger reject-btn' onclick='confirmRejectStatus(
                      {$row['id']},
                      \"{$row['column_6']}\",  // column_6
                      \"{$row['column_5']}\" // column_14
                  )'>X</button>";
                    echo "</div>";
                } else if  ($row['column_6'] === 'Rejetée')  {
                    echo "<img src='Images/rejected.png' alt='Icon' width='30' height='30'>";
                }  else  {
                  echo "<img src='Images/checked.png' alt='Icon' width='25' height='25'>";
              } 
                echo "</td>";
                echo "</tr>";
                $counter++; // Increment counter for next row
            }
        }
        $total_records = mysqli_num_rows($conn->query("SELECT * FROM `wp_tablesome_table_6958`"));
        $total_pages = ceil($total_records / $records_per_page);
        echo "<tr><td colspan='10' align='center'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='?page={$i}' class='btn btn-sm btn-secondary'";
            if ($i == $page) echo " style='font-weight:bold;'";
            echo ">{$i}</a> ";
        }
        echo "</td></tr>";
        $conn->close();
        ?>
    </tbody>
</table>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
function confirmSendSMS(recipientPhoneNumber, smsMessage) {
    var confirmation = confirm("Voulez-vous envoyer ce SMS?");
    if (confirmation) {
        window.location.href = 'sendsms.php?recipientPhoneNumber=' + encodeURIComponent(recipientPhoneNumber) + '&smsMessage=' + encodeURIComponent(smsMessage);
    }
}
</script>

<!-- Modal for confirmation -->
<div id="confirmationModal" class="modal">
  <div class="modal-content">
    <p id="modalMessage"></p>
    <button id="ouiBtn">OUI</button>
    <button id="nonBtn">NON</button>
  </div>
</div>

<script> 
 $(document).ready(function() {
    $("#searchInput").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#dataTable tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

  });
  function exportToExcel() {
    const table = document.getElementById("dataTable");
    const rows = table.querySelectorAll("tbody tr");

    let data = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'>";
    data += "<head><meta charset='UTF-8'></head>";
    data += "table { border-collapse: collapse; width: 100%; }";
    data += "th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }";
    data += "tr:nth-child(even) { background-color: #f2f2f2; }";
    data += "</style></head><body><table><thead><tr>";

    table.querySelectorAll("thead th").forEach((th) => {
      data += `<th>${th.innerText}</th>`;
    });

    data += "</tr></thead><tbody>";

    rows.forEach((row) => {
      data += "<tr>";
      row.querySelectorAll("td").forEach((cell) => {
        data += `<td>${cell.innerText}</td>`;
      });
      data += "</tr>";
    });

    data += "</tbody></table></body></html>";

    const blob = new Blob([data], { type: "application/vnd.ms-excel" });
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "attestationstravail.xls";

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  function customConfirm(message, callback) {
    document.getElementById('modalMessage').innerText = message;
    document.getElementById('confirmationModal').style.display = 'block';

    document.getElementById('ouiBtn').addEventListener('click', function() {
      document.getElementById('confirmationModal').style.display = 'none';
      callback(true);
    });

    document.getElementById('nonBtn').addEventListener('click', function() {
      document.getElementById('confirmationModal').style.display = 'none';
      callback(false);
    });
  }

  function confirmUpdateStatus(id_demande, column_3, column_11, column_9) {
    // Retrieve user details from local storage
    var storedUser = localStorage.getItem('loggedInUser');

    if (storedUser) {
        // Parse the JSON string back to a JavaScript object 
        var user = JSON.parse(storedUser);

        // Display the full name of the connected user in the navbar brand
        var loggedInUserFullName = user.full_name;

        customConfirm("Êtes-vous sûr de vouloir marquer cette demande comme étant traité ?", function (isConfirmed) {
            if (isConfirmed) {
                if (column_3.trim() !== "") {
                    customConfirm("Voulez-vous envoyer un SMS pour cette demande ?", function (sendSMS) {
                        var smsText = "Votre attestation de travail est prête à être récupérée";

                        var url = `rhprescript.php?id=${id_demande}&traiteparColumn=column_12&userColumn=${loggedInUserFullName}&table=wp_tablesome_table_6958&update=column_6&smstext=${encodeURIComponent(smsText)}`;

                        if (sendSMS) {
                            url += `&tel=${encodeURIComponent(column_3)}`;
                        }

                        window.location.href = url;
                    });
                } else {
                    window.location.href = `rhprescript.php?id=${id_demande}&traiteparColumn=column_12&userColumn=${loggedInUserFullName}&update=column_6&table=wp_tablesome_table_6958&smstext=Votre attestation de travail est prête à être récupérée`;
                }
            }
        });
    } else {
        alert("User details not found!");
    }
}

function confirmRejectStatus(id_demande, column_6, column_15) {
    var storedUser = localStorage.getItem('loggedInUser');
    if (storedUser) {
        var user = JSON.parse(storedUser);
        var loggedInUserFullName = user.full_name;
        customConfirm("Êtes-vous sûr de vouloir marquer cette demande comme étant Rejeté ?", function (isConfirmed) {
            if (isConfirmed) {
                var url = `reject.php?id=${id_demande}&traiteparColumn=column_12&userColumn=${loggedInUserFullName}&table=wp_tablesome_table_6958&update=column_6`;
                window.location.href = url; 
            } else {
                alert("Rejet de la demande annulé.");
            }
        });
    } else {
    }
}

</script>

</body>
</html>
