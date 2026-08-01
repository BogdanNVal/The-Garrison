<?php
require 'assets/clase/rezervare_masa.php';

require 'dbconnection.php';
$input = trim($_POST['input']);

$result = null;
if ($input != "") {
  $like = $input . "%";
  $stmt = $conn->prepare("SELECT * FROM rezervari WHERE nume LIKE ?");
  $stmt->bind_param("s", $like);
  $stmt->execute();
  $result = $stmt->get_result();
}

if ($result && mysqli_num_rows($result) > 0) {
?>

<table class="table table-bordered table-striped mt-4">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nume rezervare</th>
      <th>Numar persone</th>
      <th>Data rezervare</th>
      <th>Masa rezervare</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = mysqli_fetch_array($result)) {
      $id = $row["id"];
      $nume_rezervare = $row["nume"];
      $nr_persoane = $row["nr_persoane"];
      $data_rezervare = $row["data_rezervare"];
      $masa_rezervara = $row["id_masa"];
    ?>
    <tr>
      <td><?php echo $id; ?></td>
      <td><?php echo $nume_rezervare; ?></td>
      <td><?php echo $nr_persoane; ?></td>
      <td><?php echo $data_rezervare; ?></td>
      <td><?php echo $masa_rezervara; ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<?php
} else {
  echo "<h6 class='text-danger text-center mt-3'>NO DATA FOUND</h6>";
}
?>
