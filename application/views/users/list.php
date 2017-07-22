<?php include_once APPPATH.'views'.DIRECTORY_SEPARATOR . 'header.php' ?>
<script>
    $(document).ready(function () {
        userObj.setBaseUrl('<?php echo site_url(); ?>');
        userObj.init();
    });
</script>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Users List</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    </div>
                    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    </div>
                    <div class="panel-heading">
                        Users List
                        <div class="pull-right">
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle btn-xs" type="button"
                                        id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                    <span class="glyphicon glyphicon-cog"></span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li role="presentation">
                                        <a class="btn-new-user" role="menuitem" tabindex="-1" href="#"
                                           data-toggle="modal" data-target="#newUserModal">New User</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="usersListTable" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr data-user-id="<?php echo $user['id'] ?>">
                                        <td class="first-name"><?php echo $user['first_name'] ?></td>
                                        <td class="last-name"><?php echo $user['last_name'] ?></td>
                                        <td class="email"><?php echo $user['email'] ?></td>
                                        <td align="center">
                                            <span class="btn-link btn-edit-user"
                                                  data-toggle="modal" data-target="#editUserModal"
                                                  data-user-id="<?php echo $user['id'] ?>">Edit</span>
                                           </td>
                                        <td align="center">
                                            <span class="delete-user"
                                               data-user-delete-url="<?php echo site_url('users/delete/' . $user['id']) ?>"
                                               onClick="return confirm('Are you sure you want to delete?')">Delete</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
                <?php // include_once 'login.php'?>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php include_once APPPATH.'views'.DIRECTORY_SEPARATOR . 'footer.php' ?>
