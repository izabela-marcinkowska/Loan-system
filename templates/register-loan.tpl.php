<div class="pure-u-1-1">
  <h2>Registrera lån</h2>

  <form action="register-loan.php" method="post" class="pure-form">
    <fieldset>
      <legend><strong>Lägg till lån</strong></legend>
      <label for="item">Enhet: </label>
      <select name="item">
        <?php
        // Does the user have an active loan for the item?
        if (!empty($items)) {
          foreach ($items as $row) {
            // If not, show item
            if ($row['active'] != 1) {
        ?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
        <?php
            }
          }
        } ?>
      </select>
      <label for="user">Användare: </label>
      <select name="user">
        <?php
        // If there are users, loop through them
        if (!empty($users)) {
          foreach ($users as $row) {
        ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?></option>
        <?php
          }
        } ?>
      </select>
      <!-- Add dropdown with return date value to save -->
      <label for="returndate">Returnera innan: </label>
      <input type="date" name="returndate" placeholder="yyyy-mm-dd">
      <input type="submit" name="addLoan" value="Lägg till lån" class="pure-button pure-button-primary">
    </fieldset>
  </form>
</div>
