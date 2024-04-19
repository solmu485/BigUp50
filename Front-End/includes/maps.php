<head>
  <meta charset="UTF-8">
  <title>Game Modes and Maps</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid black;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h1>Game Modes and Maps</h1>
  <table>
    <thead>
      <tr>
        <th>Game Mode</th>
        <th>Maps</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include 'db_connection.php';

      $sql = "SELECT g.name as game_mode, m.name as map
              FROM gamemodes g
              JOIN gamemode_map gm ON g.id = gm.gamemode_id
              JOIN maps m ON gm.map_id = m.id
              ORDER BY g.name, m.name";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $current_game_mode = null;

        while($row = $result->fetch_assoc()) {
          if ($current_game_mode != $row['game_mode']) {
            if ($current_game_mode) {
              echo '</ul>';
            }
            echo '<tr><td rowspan="' . $row_count . '">' . $row['game_mode'] . '</td><td><ul>';
            $current_game_mode = $row['game_mode'];
            $row_count = 0;
          }
          echo '<li>' . $row['map'] . '</li>';
          $row_count++;
        }
        echo '</ul></td></tr>';
      } else {
        echo '<tr><td colspan="2">No data found.</td></tr>';
      }

      $conn->close();
      ?>
    </tbody>
  </table>
</body>