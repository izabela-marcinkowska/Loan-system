<div class="grid-g-1-1">
  <h2>Registrerade lån</h2>

  <table class="pure-table">
    <thead>
      <tr>
        <th>Enhet</th>
        <th>Beskrivning</th>
        <th>Användare</th>
        <th>Lånedatum</th>
        <th>Returdatum</th>
        <th>Returnera</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (!empty($loans)) {
        foreach ($loans as $row) {
      ?>
          <tr>
            <td><?php echo $row['itemtype'] ?></td>
            <td><?php echo $row['description'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['loandate'] ?></td>
            <td><?php echo $row['returndate'] ?></td>
            <td>
              <?php
              if ($row['active'] == '1') {
                echo '<a href="dblabb4.php?returnItem=' . $row['lid'] . '">Returnera</a>';
              } else {
                echo "Ej aktivt lån";
              }
              ?>
            </td>
          </tr>
      <?php
        }
      }
      ?>
    </tbody>
  </table>

</div>
