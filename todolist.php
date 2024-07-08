<?php
session_start();

if(!isset($_SESSION["tugas"])) {
  $_SESSION["tugas"] = [];
}

if(isset($_POST["action"])) {
  $action = $_POST["action"];

  if($action == "tambah" && isset($_POST["tugas"])) {
    $tugas = trim($_POST["tugas"]);

    if(!empty($tugas)) {
      $_SESSION["tugas"][] = $tugas;
    }
  }
  else if ($action == "hapus" && isset($_POST["index"])) {
    $index = (int)$_POST["index"];

    if(isset($_SESSION["tugas"][$index])) {
      unset($_SESSION["tugas"][$index]);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
</head>
<body>
  <h1>To-Do List</h1>
  <form method="POST">
    <input type="hidden" name="action" value="tambah">
    <input type="text" name="tugas">
    <button>Tambah Tugas</button>
  </form>
  <table>
    <?php foreach($_SESSION["tugas"] as $index => $tugas): ?>
    <tr>
      <td>
        <?= htmlspecialchars($tugas); ?>
      </td>
      <td>
        <form method="POST">
          <input type="hidden" name="action" value="hapus">
          <input type="hidden" name="index" value="<?= $index ?>">
          <button>Hapus</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
