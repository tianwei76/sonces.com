<?php if (\Phpcmf\Service::M('auth')->is_post_user()) { ?>
<div class="portlet portlet-sortable light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-bell"></i>
            <span class="caption-subject"> <?php echo dr_lang('系统提醒'); ?></span>
        </div>
        <div class="actions">
            <a href="javascript:dr_ajax_url('<?php echo dr_url('api/clear_notice'); ?>');" class="btn red btn-xs">
                <i class="fa fa-trash"></i> <?php echo dr_lang('清除'); ?>
            </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible="0">
        <?php if (dr_is_app('notice')) { ?>
            <?php $list_return = $this->list_tag("action=table table=member_notice isnew=1 uid=$member[uid] order=inputtime cache=0"); if ($list_return && is_array($list_return)) extract($list_return, EXTR_OVERWRITE); $count=dr_count($return); if (is_array($return)) { $key=-1; foreach ($return as $t) { $key++; $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?> <?php } } ?>
            <?php if (!$return) { ?>
            <div style="padding-top: 30px;padding-bottom: 30px;text-align: center;color: #d7d8da;"> <?php echo dr_lang('无任何提醒'); ?> </div>
            <?php }  if ($return) { ?>
            <ul class="feeds" style="padding-bottom: 20px">
                <?php if (is_array($return)) { $key_t=-1;$count_t=dr_count($return);foreach ($return as $t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;?>
                <li>
                    <div class="col1" style="padding-top: 2px;padding-left: 3px;">
                        <div class="cont">
                            <div class="cont-col1" style="padding-top: 5px;">
                                <?php echo dr_notice_icon($t['type'], 'label-icon'); ?>
                            </div>
                            <div class="cont-col2">
                                <div class="desc" style="margin-left: 18px;"><?php echo $t['content']; ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col2">
                        <div class="date"> <?php echo dr_fdate($t['inputtime']); ?> </div>
                    </div>
                </li>
                <?php } } ?>
            </ul>
            <?php }  } else { ?>
        <div style="padding-top: 30px;padding-bottom: 30px;text-align: center;color: #d7d8da;"> <?php echo dr_lang('无任何提醒'); ?> </div>
        <?php } ?>

        </div>
    </div>
</div>

<?php } else { ?>
<div class="portlet portlet-sortable light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-bell"></i>
            <span class="caption-subject"> <a href="<?php echo dr_url('notice/my_index'); ?>"><?php echo dr_lang('系统提醒'); ?></a> </span>
        </div>
    </div>
    <div class="portlet-body">

        <div class="scroller" style="height: 250px;" data-always-visible="1" data-rail-visible="0">
            <?php $notice = \Phpcmf\Service::M('auth')->admin_notice(); if (!$notice) { ?>
            <div style="padding-top: 30px;padding-bottom: 30px;text-align: center;color: #d7d8da;"> <?php echo dr_lang('无任何提醒'); ?> </div>
            <?php } else { ?>
            <ul class="feeds" style="padding-bottom: 20px">
                <?php if (is_array($notice)) { $key_t=-1;$count_t=dr_count($notice);foreach ($notice as $t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;?>
                <li>
                    <div class="col1" style="padding-top: 2px;padding-left: 3px;">
                        <div class="cont">
                            <div class="cont-col1 user-avatar">
                                <a href="<?php echo dr_url('api/notice', array('id' => $t['id'])); ?>"><img style="height: 25px!important;" src="<?php echo dr_avatar($t['uid']); ?>" /></a>
                            </div>
                            <div class="cont-col2">
                                <div class="desc"><a href="<?php echo dr_url('api/notice', array('id' => $t['id'])); ?>"><?php echo $t['msg']; ?></a></div>
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
<?php } ?>