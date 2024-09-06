<div class="modal" id="loginModal">
        <div class="modal-box">
            <span class="close" id="closeModal">&times;</span>
            <form action="/ThreadX/dependencies/_handles_login.php" method="post" id="loginForm">
                <h2>Login</h2>
                <label for="loginUsername">Username:</label>
                <input type="text" id="loginUsername" name="loginUsername" required>
                <label for="loginPassword">Password:</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>