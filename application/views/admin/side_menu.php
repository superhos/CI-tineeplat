<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
 
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title">Gentellela Alela!</a>
        </div>
 
        <div class="profile"><!--img_2 -->
            <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Anthony Mutisya</h2>
            </div>
        </div>
 
        <br>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
 
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                <?php foreach ($menu as $key => $value): ?>
                    <?php if (isset($value['child'])): ?>
                    <li><a><i class="fa <?php echo $value['icon']; ?>"></i> <?php echo $value['title']; ?> <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <?php foreach ($value['child'] as $k => $v): ?>
                            <li><a href="<?php echo site_url().'/'.$v['uri']; ?>"><?php echo $v['title']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php else: ?>
                        <li><a href="<?php echo site_url().'/'.$value['uri']; ?>"><i class="fa <?php echo $value['icon']; ?>"></i> <?php echo $value['title']; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
 
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>