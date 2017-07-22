
<script>
    $(document).ready(function () {
        userObj.init();
    });
</script>
<!-- The Modal -->
<div id="loginModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <form id="loginForm" method="post" name="login" action="<?php echo site_url('users/login') ?>">
            <table width="70%" border="1">
                <tr>
                    <td>
                        <label for="email">Email:</label>
                    </td>
                    <td>
                        <input id="email" type="email" name="email" value="">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:</label>
                    </td>
                    <td>
                        <input id="password" type="password" name="password" value="">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input id="submitLogin" type="button" name="loginForm" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div>
    <a id="loginLink" href="#">Login</a>
</div>
