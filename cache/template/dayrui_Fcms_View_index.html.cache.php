<?php if ($fn_include = $this->_include("head.html")) include($fn_include); ?>

<body scroll="no" style="overflow: hidden;" class="page-sidebar-closed-hide-logo page-admin-all page-content-white page-header-fixed page-sidebar-fixed ">
<style>.page-content {padding:0px !important;} </style>
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo" style="font-size: 21px;
line-height: 70px;
font-weight: bold;
color: #fff;
text-transform: uppercase;">
            CryptoDeer
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <div class="top-menu my-top-left pull-left">
            <ul class="nav navbar-nav pull-left fc-all-menu-top ">
                <?php if (is_array($top)) { $key_t=-1;$count_t=dr_count($top);foreach ($top as $t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;?>
                <li id="dr_menu_top_<?php echo $t['id']; ?>" class="dropdown <?php if ($t['id']==$first) { ?>open<?php } ?>">
                    <a class="dropdown-toggle popovers" href="javascript:Mlink('<?php echo $t['id']; ?>', '<?php echo $t['left_id']; ?>', '<?php echo $t['link_id']; ?>', '<?php echo $t['url']; ?>');" style="padding-left: 50px;padding-right: 50px;">
                        <div class="menu-top-icon"><i class="<?php echo $t['icon']; ?>"></i></div>
                        <div class="menu-top-name"><i class="top-txt-menu"><?php echo dr_lang($t['name']); ?></i></div>
                    </a>
                </li>
                <?php } } ?>
            </ul>
        </div>
        <div class="top-menu my-top-right">
            <ul class="nav navbar-nav pull-right">
                <?php if ($is_mobile) { ?>
                <li class="dropdown fc-mini-menu-top">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-bars"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default fc_mini_menu_top">
                        <?php if (is_array($top)) { $key_t=-1;$count_t=dr_count($top);foreach ($top as $t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;?>
                        <li>
                            <a id="dr_mini_menu_top_<?php echo $t['id']; ?>" class="dr_mini_menu_top <?php if ($t['id']==$first) { ?>open<?php } ?>" href="javascript:Mlink('<?php echo $t['id']; ?>', '<?php echo $t['left_id']; ?>', '<?php echo $t['link_id']; ?>', '<?php echo $t['url']; ?>');">
                                <i class="<?php echo $t['icon']; ?>"></i> <?php echo dr_lang($t['name']); ?>
                            </a>
                        </li>
                        <?php } } ?>
                    </ul>
                </li>
                <?php echo $mstring;  }  if (count($ci->site_info) > 1) { ?>
                <li class="dropdown dropdown-extended dropdown-tasks">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <div class="menu-top-icon"><i class="fa fa-share-alt"></i>
                        </div>
                        <div class="top-txt-menu"><?php echo dr_lang('多站'); ?></div>
                    </a>
                    <ul class="dropdown-menu extended tasks">
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height:400px;overflow: scroll;" data-handle-color="#637283">
                                <?php if (is_array($ci->site_info)) { $key_t=-1;$count_t=dr_count($ci->site_info);foreach ($ci->site_info as $i=>$t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;  if (\Phpcmf\Service::M('auth')->_check_site($i)) { ?>
                                <li>
                                    <a href="javascript:;" onclick="dr_select_site('<?php echo $i; ?>')" title="<?php echo $t['SITE_NAME']; ?>" <?php if (SITE_ID == $i) { ?>style="color:red"<?php } ?>>
                                        <p style="margin: 0"><?php echo dr_strcut($t['SITE_NAME'], 30); ?></p>
                                        <p style="margin: 0;font-size: 10px;margin-top: -4px;"><?php echo trim(str_replace(['http://', 'https://'], '', $t['SITE_URL']), '/'); ?></p>
                                    </a>
                                </li>
                                <?php }  } } ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php }  if ($is_mobile) { ?>
                <li class="dropdown">
                    <a href="javascript:;"  class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <div class="menu-top-icon"> <i class="fa fa-wrench"></i> </div>
                        <div class="menu-top-icon"><i class="top-txt-menu"><?php echo dr_lang('账号'); ?></i></div>
                    </a>
                    <?php } else { ?>
                <li class="dropdown dropdown-user">
                    <a style="margin-right: -10px;" href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="<?php echo $admin['username']; ?>" class="img-circle" src="<?php echo dr_avatar($admin['uid']); ?>" />
                        <span class="username username-hide-on-mobile"> <?php echo dr_strcut($admin['username'], 8); ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <?php } ?>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <?php if (IS_USE_MEMBER) { ?><li><a href="<?php echo dr_url('api/alogin', ['id'=>$admin['uid']]); ?>" target="_blank"><i class="fa fa-user"></i> <?php echo dr_lang('用户中心'); ?> </a></li><?php } ?>
                        <li><a href="javascript:dr_go_url('<?php echo dr_url('api/my'); ?>');"><i class="fa fa-edit"></i> <?php echo dr_lang('修改资料'); ?> </a></li>
                        <li><a href="<?php echo dr_url('api/admin_min'); ?>"><i class="fa fa-retweet"></i> <?php echo dr_lang('简化模式'); ?></a></li>
                        <li><a href="javascript:;" onClick="dr_logout('<?php echo dr_url('login/out'); ?>');"><i class="fa fa-user-times"></i> <?php echo dr_lang('退出系统'); ?></a></li>
                        <li class="divider"> </li>

                        <li><a href="javascript:dr_update_cache_all();"><i class="fa fa-refresh"></i> <?php echo dr_lang('更新缓存'); ?></a></li>
                        <li><a href="javascript:dr_update_cache_data();"><i class="fa fa-trash"></i> <?php echo dr_lang('更新数据'); ?></a></li>
                        <?php if ($admin['adminid']==1) { ?>
                        <li class="divider"> </li>
                        <li><a href="javascript:dr_go_url('<?php echo dr_url('error/index'); ?>');"><i class="fa fa-shield"></i> <?php echo dr_lang('系统日志'); ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if (!$is_mobile) { ?>
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle">
                        <i class="fa fa-bell-o"></i>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<div class="clearfix"> </div>

<div class="page-container">
    <div class="page-sidebar-wrapper">

        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed  page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>

               
                <?php echo $string; ?>
            </ul>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content index-content">
            <?php if (!SYS_NOT_ADMIN_CACHE && !$is_mobile) { ?>
            <ul class="page-toolbar fc-mb-left-menu" id="dr_go_url">
            </ul>
            <?php } ?>
            <div id="myiframe" cid="right_page">
                <iframe class="myiframe active" name="right" id="right_page" src="<?php echo $main_url; ?>" url="<?php echo $main_url; ?>" style="border:none; margin-bottom:0px;" width="100%" height="auto" allowtransparency="true"></iframe>
            </div>
        </div>
    </div>

    <?php if (!$is_mobile) { ?>
    <a href="javascript:;" class="page-quick-sidebar-toggler">
        <i class="fa fa-angle-double-left"></i>
    </a>
    <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
        <div class="page-quick-sidebar">
            <?php $notice = \Phpcmf\Service::M('auth')->admin_notice(10, true);?>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> <?php echo dr_lang('系统提醒'); ?></a>
                </li>
            </ul>
            <div class="tab-content">

                <div class="tab-pane active page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                    <?php if ($notice) { ?>
                    <ul class="feeds list-items">
                        <?php if (is_array($notice)) { $key_t=-1;$count_t=dr_count($notice);foreach ($notice as $t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;?>
                        <li>
                            <div class="col1" style="padding-top: 2px;padding-left: 3px;">
                                <div class="cont">
                                    <div class="cont-col1 user-avatar">
                                        <a  onclick="dr_hide_left_tab()" href="javascript:dr_go_url('<?php echo dr_url('api/notice', array('id' => $t['id'])); ?>');"><img style="height: 25px!important;" src="<?php echo dr_avatar($t['uid']); ?>" /></a>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"><a style="color: #c1cbd0"  onclick="dr_hide_left_tab()" href="javascript:dr_go_url('<?php echo dr_url('api/notice', array('id' => $t['id'])); ?>');"><?php echo $t['msg']; ?></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> <?php echo dr_fdate($t['inputtime']); ?> </div>
                            </div>
                        </li>
                        <?php } } ?>
                    </ul>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>
    <?php } ?>
</div>
<script>
    // 关闭栏
    function dr_hide_left_tab() {
        $(".page-quick-sidebar-toggler").click();
    }
    if (self != top) {
        top.location.href = admin_file;
    }
    var url = '<?php echo dr_url_prefix('/'); ?>';
    var p = url.split('/');
    var ptl = document.location.protocol;
    if ((p[0] == 'http:' || p[0] == 'https:') && ptl != p[0]) {
        alert('当前访问是'+ptl.replace(':', '')+'模式，本项目设置的是'+p[0].replace(':', '')+'模式，请使用'+p[0].replace(':', '')+'模式访问');
    }
</script>
</body>
</html>