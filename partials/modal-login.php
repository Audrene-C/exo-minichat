<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Please log in :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="./partials/login.php" method="POST" id="login-form" class="d-flex">
            <div class="container-fluid d-flex">    
                <div>
                    <label for="loginNickname">Nickname :</label>
                    <input type="text" name="loginNickname" id="loginNickname" value="<?=$_COOKIE["nickname"];?>" required>
                </div>
                <div>
                    <label for="loginPassword">Your password :</label>
                    <input type="password" name="loginPassword" id="loginPassword" required>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Login">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>