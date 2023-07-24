<div class="pure-u-1-2">

  <form action="add-loan.php" method="post" class="pure-form">
    <fieldset>
      <legend><strong>Lägg till enhet</strong></legend>
      <input type="text" name="name" placeholder="Namn">
      <input type="submit" name="addType" value="Lägg till enhet" class="pure-button pure-button-primary">
    </fieldset>
  </form>

  <h4>Lista enheter</h4>
  <ul>
    <?php
    if (!empty($items)) {
      foreach ($items as $row) {
    ?>
        <li><strong><?php echo $row['name'] ?>: </strong>
          <?php echo $row['description'] ?? ''; ?>
          <a href="add-loan.php?delType=<?php echo $row['tid'] ?>">Radera</a>
        </li>
    <?php
      }
    }
    ?>
  </ul>

</div>

<div class="pure-u-1-2">

  <form action="add-loan.php" method="post" class="pure-form">
    <fieldset>
      <legend><strong>Lägg till beskrivning för enhet</strong></legend>
      <select name="type">
        <?php
        if (!empty($items)) {
          foreach ($items as $row) {
        ?>
            <option value="<?php echo $row['tid'] ?>"><?php echo $row['name'] ?></option>
        <?php
          }
        } ?>
      </select>
      <input type="text" name="desc" placeholder="Beskrivning">
      <input type="submit" name="addItem" value="Lägg till" class="pure-button pure-button-primary">
    </fieldset>
  </form>
</div>
