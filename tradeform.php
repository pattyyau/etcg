<?php if ( isset($error) ) { foreach ( $error as $msg ) {  ?><p style="color:red;"><strong>ERROR!</strong> <?php echo $msg; ?></p><?php } } ?>

<form action="trade.php" method="post" name="trades" id="trades">
  <fieldset>
    <legend>Trade Info</legend>
    <div>
      <label for="name">Name</label>
      <input type="text" name="name" id="name" value="<?php if ( isset($_POST['tradesubmit']) ) { echo $_POST['name']; } ?>">
    </div>
  	<div>
  	  <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php if ( isset($_POST['tradesubmit']) ) { echo $_POST['email']; } ?>">
    </div>
    <div>
      <label for="website">Website</label>
      <input name="website" type="text" id="website" value="<?php if ( isset($_POST['tradesubmit']) ) { echo $_POST['website']; } else { echo 'http://'; } ?>">
    </div>
    <div>
      <label for="tcg">TCG</label>
      <select name="tcg" id="tcg">
      <?php $database = new Database;
      $hiatustrading = $database->get_assoc("SELECT `value` FROM `settings` WHERE `setting`='hiatustrading' LIMIT 1");
      $hiatustrading = $hiatustrading['value'];
      $inactivetrading = $database->get_assoc("SELECT `value` FROM `settings` WHERE `setting`='inactivetrading' LIMIT 1");
      $inactivetrading = $inactivetrading['value'];
      
      if ( $hiatustrading == 0 && $inactivetrading == 0 ) { $result = $database->query("SELECT `id`,`name` FROM `tcgs` WHERE `status`='active' ORDER BY `name`"); }
      else if ( $hiatustrading == 1 && $inactivetrading == 1 ) { $result = $database->query("SELECT `id`,`name` FROM `tcgs` ORDER BY `name`"); }
      else if ( $hiatustrading == 1 ) { $result = $database->query("SELECT `id`,`name` FROM `tcgs` WHERE `status`='active' OR `status`='hiatus' ORDER BY `name`"); }
      else if ( $inactivetrading == 1 ) { $result = $database->query("SELECT `id`,`name` FROM `tcgs` WHERE `status`='active' OR `status`='inactive' ORDER BY `name`"); }
      
      while ( $row = mysqli_fetch_assoc($result) ) {
          echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
          } ?>
      </select>
    </div>
    <div>
      <label for="wants">Cards You Want</label>
      <textarea name="wants" id="wants" cols="50" rows="2"><?php if ( isset($_POST['tradesubmit']) ) { echo $_POST['wants']; } ?></textarea>
    </div>
    <div>
      <label for="offer">For Your Cards (Offer)</label>
      <textarea name="offer" id="offer" cols="50" rows="2"><?php if ( isset($_POST['tradesubmit']) ) { echo $_POST['offer']; } ?></textarea>
    </div>
    <div>
      <label for="comments">Comments? Member Cards?</label>
      <textarea name="comments" id="comments" cols="50" rows="4"><?php if ( isset($_POST['tradesubmit']) ) { echo $_POST['comments']; } ?></textarea>
    </div>

    <input type="submit" name="tradesubmit" id="tradesubmit" value="Submit">

  </fieldset>
</form>