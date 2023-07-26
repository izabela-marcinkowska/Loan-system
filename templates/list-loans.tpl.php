<div class="grid-g-1-1">
  <h2>Registrerade lån</h2>
<!-- Create a table of all loans  -->
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
      <!-- go though every row in loans and print out to the table -->
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
              // if loan is active print out link to return a loan
              if ($row['active'] == '1') {
                echo '<a href="register-loan.php?returnItem=' . $row['lid'] . '">Returnera</a>';
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
