<?php declare(strict_types = 1); ?>

<?php function drawProfileInfoForm(User $user) { ?>
<h2>Profile</h2>
<form action="../action/action_edit_profile.php" method="post" class="profile">

  <label for="first_name">First Name:</label>
  <input id="first_name" type="text" name="first_name" value="<?=$user->firstName?>" required="required">
  
  <label for="last_name">Last Name:</label>
  <input id="last_name" type="text" name="last_name" value="<?=$user->lastName?>" required="required">
  
  <label for="adress">Address:</label>
  <input id="adress" type="text" name="adress" value="<?=$user->adress?>" required="required">

  <label for="phone">Phone Number:</label>
  <input id="phone" type="text" name="phone" value="<?=$user->phone?>" required="required">
  
  <button type="submit">Save</button>

  <p id="error_messages" style="color: black">
    <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
  </p>
</form>
<?php } ?>

<?php function drawAccountInfoForm(User $user) { ?>
<h2>Profile</h2>
<form action="../action/action_update_password.php" method="post" class="account">

  <label for="password">New password:</label>
  <input id="password" type="password" name="password">
  
  <label for="repeat">Repeat new password:</label>
  <input id="repeat" type="password" name="repeat">  
  
  <button type="submit">Save</button>

  <p id="error_messages" style="color: black">
    <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
  </p>
</form>
<?php } ?>


<?php function drawProfile(User $user) { ?>
<h2>Profile  <?php echo $_SESSION['usertype'];?> </h2>
<article>
  <ul>
    <li>Username: <?=$user->username ?></li>
    <li>First name: <?= $user->firstName ?></li>
    <li>Last name: <?= $user->lastName ?></li>
    <li>Address: <?= $user->adress ?></li>
    <li>Phone number: <?= $user->phone ?></li>
  </ul>
</article>
<p>
  <a href="../pages/profile.php?id=profile"> Edit Profile Info</a> | <a href="../pages/profile.php?id=account">Edit Account Info</a>
</p>
<p>
  <input onclick="openDialog('Delete Account')" type="submit" value="Delete Account">
  <div id="delete" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete your account forever? It is a very long time.</p>
        <div class="buttons">
            <input onclick="closeDialog('Delete Account')" type="button" value="Cancel">
            <form action="../action/action_delete_account.php" method="post">
                <input type="submit" name="Submit" value="Delete">
            </form>
        </div>
    </div>
</div>
</p>
<?php } ?>