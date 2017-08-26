<section class="menu-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navbar-collapse collapse ">
                    <?php $currentPage = $this->session->userdata('current_page'); ?>
                    <ul id="menu-top" class="nav navbar-nav navbar-right">
                        <li>
                            <a <?php echo $currentPage == 'main' ? 'class="menu-top-active"' : '' ?>
                                href="<?php echo base_url()?>">Dashboard</a>
                        </li>
                        <li>
                            <a <?php echo $currentPage == 'users' ? 'class="menu-top-active"' : '' ?>
                                href="<?php echo base_url()?>users">Users</a>
                        </li>
                        <?php $currentUser = $this->session->userdata('currentUser'); ?>
                        <?php if (empty($currentUser)): ?>
                        <li>
                            <a <?php echo $currentPage == 'authorize' ? 'class="menu-top-active"' : '' ?>
                                href="<?php echo base_url()?>authorize/register">Sigh In/Sign Up</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MENU SECTION END-->
