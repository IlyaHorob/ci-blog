var userObj = {
    newUserFormId: 'newUserFormId',
    editUserFormId: 'editUserFormId',
    newUserModal: 'newUserModal',
    editUserModal: 'editUserModal',
    usersListTable: 'usersListTable',
    newUserBtn: 'btn-new-user',
    editUserBtn: 'btn-edit-user',
    baseUrl: '',
    
    init: function () {
        this.initNewUserForm();
        this.initEditUserForm();
        this.initDeleteUser();
    },
    
    setBaseUrl: function (url) {
        this.baseUrl = url;
    },
    
    clearForm: function (modal) {
        modal.find('input[name="firstname"]').val('');
        modal.find('input[name="lastname"]').val('');
        modal.find('input[name="email"]').val('');
    },
    
    initNewUserForm: function () {
        var self = this;
        
        $('.' + self.newUserBtn).click(function () {
            if (!$('#' + self.newUserFormId).length) {
                $.ajax({
                    type: 'POST',
                    url: self.baseUrl + '/users/getNewUserForm',
                    dataType: 'json',
                    success: function (response) {
                        if (response.result) {
                            $('#' + self.newUserModal).html(response.form);
                            self.initNewUser();
                        }
                    }
                });
            }
        });
    },
    
    initEditUserForm: function () {
        var self = this;
        
        $('.' + self.editUserBtn).click(function () {
            var userId = $(this).data('user-id');
            $.ajax({
                type: 'POST',
                url: self.baseUrl + '/users/getEditUserForm/' + userId,
                dataType: 'json',
                success: function (response) {
                    if (response.result) {
                        $('#' + self.editUserModal).html(response.form);
                        self.initEditUser();
                    }
                }
            });
    });
    },
    
    initNewUser: function () {
        var self = this;
        
        $('#saveUser').click(function () {
            var form = $('#' + self.newUserFormId);
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    var messages = $('.messages');
                    messages.html('');
                    if (!response.result) {
                        if (response.errors != undefined) {
                            messages.html(response.errors);
                        }
                    } else {
                        if (response.userRow != undefined) {
                            $('#' + self.usersListTable).find('tbody').append(response.userRow);
                            self.initDeleteUser();
                        }
                        var modal = $('#' + self.newUserModal);
                        modal.find('.btn-close-form').trigger('click');
                        self.clearForm(modal);
                    }
                }
            });
        });
    },
    
    initEditUser: function () {
        var self = this;
        
        $('#saveUser').click(function () {
            var form = $('#' + self.editUserFormId);
            $.ajax({
                type: 'POST',
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                success: function (response) {
                    var messages = $('.messages');
                    messages.html('');
                    if (!response.result) {
                        if (response.errors != undefined) {
                            messages.html(response.errors);
                        }
                    } else {
                        self.updateUserInTable(response.user);
                        var modal = $('#' + self.editUserModal);
                        modal.find('.btn-close-form').trigger('click');
                        self.clearForm(modal);
                    }
                }
            });
        });
    },
    
    updateUserInTable: function (user) {
        var userRow = $('tr').filter('[data-user-id=' + user.id + ']');
        userRow.find('td.first-name').html(user.first_name);
        userRow.find('td.last-name').html(user.last_name);
        userRow.find('td.email').html(user.email);
    },
    
    initDeleteUser: function () {
        $('.delete-user').off('click').on('click', function () {
            var link = $(this);
            $.ajax({
                type: 'GET',
                url: link.data('user-delete-url'),
                data: {},
                dataType: 'json',
                success: function (response) {
                    if (response.result) {
                        link.closest('tr').remove();
                    }
                }
            });
        });
    }
};

