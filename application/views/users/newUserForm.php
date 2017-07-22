<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Modal title Here</h4>
        </div>
        <div class="modal-body">
            <div class="messages"></div>
            <?php echo form_open('users/add', ['id'=>'newUserFormId']); ?>
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
            </table>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-close-form"
                    data-dismiss="modal">Close</button>
            <button id="saveUser" type="button" class="btn btn-primary">Create User</button>
        </div>
    </div>
</div>




