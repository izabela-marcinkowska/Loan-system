<div class="pure-u-1-2">
<!-- Form to add new type itrems -->
  <form action="add-loan.php" method="post" class="pure-form">
    <fieldset>
      <legend><strong>Lägg till enhet</strong></legend>
      <input type="text" name="name" placeholder="Namn">
      <input type="submit" name="addType" value="Lägg till enhet" class="pure-button pure-button-primary">
    </fieldset>
  </form>
<!-- List with already saved items -->
  <h4>Lista enheter</h4>
  <ul>
    <!-- chceck if there are any saved items and print them out -->
    <?php
    if (!empty($items)) {
      foreach ($items as $row) {
    ?>
        <li><strong><?php echo $row['name'] ?>: </strong>
          <?php echo $row['description'] ?? ''; ?>
          <!-- Link to remove item from a list -->
          <a href="add-loan.php?delType=<?php echo $row['tid'] ?>">Radera</a>
        </li>
    <?php
      }
    }
    ?>
  </ul>

</div>

<div class="pure-u-1-2">
<!-- Form to add description to an item -->
  <form action="add-loan.php" method="post" class="pure-form">
    <fieldset>
      <legend><strong>Lägg till beskrivning för enhet</strong></legend>
      <!-- Drop down list to choose between already exisitng items -->
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
      <!-- Place to add description -->
      <input type="text" name="desc" placeholder="Beskrivning">
      <input type="submit" name="addItem" value="Lägg till" class="pure-button pure-button-primary">
    </fieldset>
  </form>
</div>
