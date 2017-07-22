<?php include_once 'header.php'?>

<h4>New user</h4>

<div id="container">
    <h2>Add new user</h2>
    
    <?php echo validation_errors(); ?>
    
    <?php echo form_open('users/add'); ?>
    <table>
        <tr>
            <td><label for="firstname">Firstname</label></td>
            <td><input type="text" name="firstname" size="50"/></td>
        </tr>
        <tr>
            <td><label for="text">Lastname</label></td>
            <td><input type="text" name="lastname" size="50"/></td>
        </tr>
        <tr>
            <td><label for="text">Email</label></td>
            <td><input type="email" name="email" size="50"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Add new user"/></td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>
