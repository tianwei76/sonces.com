<?php if ($fn_include = $this->_include("head.html")) include($fn_include); ?>
<body class="page-content-white <?php if (isset($_GET['is_iframe']) && $_GET['is_iframe'] && !isset($_GET['is_menu'])) { ?> main-content2<?php } ?>">
<style>
    .main-content2 {background: #fff!important}
    .main-content2 .note.note-danger {background-color: #f5f6f8 !important}
    .page-content3 {margin-left:0px !important; border-left: 0  !important;}
    .page-content-white .page-bar .page-breadcrumb>li>i.fa-circle {top:0px !important; }
</style>
<div class="page-container" style="margin-bottom: 0px !important;">
    <div class="page-content-wrapper">
        <div class="page-content page-content3 mybody-nheader main-content  <?php if (isset($_GET['is_iframe']) && $_GET['is_iframe'] && !isset($_GET['is_menu'])) { ?> main-content2<?php } ?>">
            <?php if ((!isset($_GET['hide_menu']) || !$_GET['hide_menu']) || isset($_GET['is_menu'])) {  if ((isset($menu) && $menu && !$_GET['is_iframe']) || isset($_GET['is_menu'])) { ?>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <?php echo $menu; ?>
                    </ul>
                    <?php if ($menu_toolbar) { ?>
                    <div class="page-toolbar">
                        <?php echo $menu_toolbar; ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="page-body" style="padding-top:15px;">
                <?php } else { ?>
                <div class="page-body">
                <?php }  } else { ?>
                <div class="page-body">
            <?php } ?>
