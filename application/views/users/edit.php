<!DOCTYPE html>
<html>
<head>
    <title> Edit User</title>
</head>
<body>

<h4>Edit user</h4>

<div id="container">
    <h2>Edit user</h2>
    
    <?php echo validation_errors(); ?>
    
    <?php echo form_open('users/edit/' . $user['id']); ?>
    <table>
        <tr>
            <td><label for="firstname">Firstname</label></td>
            <td><input type="text" name="firstname" size="50"
                       value="<?php echo $user['first_name'] ?>"/></td>
        </tr>
        <tr>
            <td><label for="text">Lastname</label></td>
            <td><input type="text" name="lastname" size="50"
                       value="<?php echo $user['last_name'] ?>"/></td>
        </tr>
        <tr>
            <td><label for="text">Email</label></td>
            <td><input type="email" name="email" size="50"
                       value="<?php echo $user['email'] ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Edit user"/></td>
        </tr>
    </table>
    </form>
</div>
</body>
</html>
