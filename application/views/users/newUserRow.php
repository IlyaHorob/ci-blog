<tr>
    <td class="first-name"><?php echo $user['first_name'] ?></td>
    <td class="last-name"><?php echo $user['last_name'] ?></td>
    <td class="email"><?php echo $user['email'] ?></td>
    <td align="center"><a href="<?php echo site_url('users/edit/' . $user['id']) ?>">Edit</a> </td>
    <td align="center">
        <span class="delete-user"
              data-user-delete-url="<?php echo site_url('users/delete/' . $user['id']) ?>"
              onClick="return confirm('Are you sure you want to delete?')">Delete</span>
    </td>
</tr>
