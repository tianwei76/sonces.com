<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8" />
    <title><?php echo dr_lang('%s - 后台管理平台', SITE_NAME); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="<?php echo $THEME_PATH; ?>assets/global/css/admin.min.css?v=<?php echo CMF_UPDATE_TIME; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $THEME_PATH; ?>assets/global/css/login.min.css?v=<?php echo CMF_UPDATE_TIME; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo defined('MYCSS_FILE') ? MYCSS_FILE : $THEME_PATH.'assets/global/css/my.css'; ?>?v=<?php echo CMF_UPDATE_TIME; ?>" rel="stylesheet" type="text/css" />
</head>
<body class="login">
<div class="content">
    <div class="page-logo" style="font-size: 21px;
line-height: 70px;
font-weight: bold;
color: #fff;
text-transform: uppercase;">
            CryptoDeer
        </div>
    <form class="login-form" action="" onsubmit="return dr_submit()" method="post">
        <?php echo $form; ?>
        <div class="alert alert-danger display-hide">
            <span>  </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('账号'); ?></label>
            <div class="input-icon">
                <input style="padding-left:15px;" class="form-control placeholder-no-fix" type="text" value="<?php echo  defined('DEMO_ADMIN_USERNAME') ? DEMO_ADMIN_USERNAME : ''?>" autocomplete="off" placeholder="<?php echo dr_lang('账号'); ?>" name="data[username]" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('密码'); ?></label>
            <div class="input-icon">
                <input style="padding-left:15px;" id="password" class="form-control placeholder-no-fix" type="password" value="<?php echo  defined('DEMO_ADMIN_PASSWORD') ? DEMO_ADMIN_PASSWORD : ''?>" autocomplete="off" placeholder="<?php echo dr_lang('密码'); ?>" name="data[password]" /> </div>
        </div>
        <?php if (SYS_ADMIN_CODE) {  if ($is_mobile) { ?>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('验证码'); ?></label>
            <div class="input-icon">
                <input style="padding-left:15px;" class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="<?php echo dr_lang('验证码'); ?>" name="code" />
            </div>
        </div>
        <div class="form-group text-center">
            <?php echo dr_code(120, 35); ?>
        </div>
        <?php } else { ?>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('验证码'); ?></label>
            <div class="input-group">
                <div class="input-icon">
                    <input style="padding-left: 15px" type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="<?php echo dr_lang('验证码'); ?>" name="code">
                </div>
                <div class="input-group-btn fc-code" style="padding-left: 10px;">
                    <?php echo dr_code(120, 35); ?>
                </div>
            </div>
        </div>
        <?php }  } ?>
        <div class="form-actions">
            <button type="button" onclick="dr_submit()" class="btn default btn-block"> <?php echo dr_lang('登录后台'); ?> </button>
        </div>
        <?php if (!SYS_ADMIN_MODE) { ?>
        <div class="form-group text-center" style="margin-bottom: -10px;">
            <div class="input-icon">
                <div class="mt-radio-inline">
                    <label class="mt-radio">
                        <input type="radio" name="data[mode]" value="1" <?php if ($mode == 1) { ?>checked=""<?php } ?>> <?php echo dr_lang('完整模式'); ?>
                        <span></span>
                    </label>
                    <label class="mt-radio">
                        <input type="radio" name="data[mode]" value="2" <?php if ($mode == 2) { ?>checked=""<?php } ?>> <?php echo dr_lang('简化模式'); ?>
                        <span></span>
                    </label>
                </div>
            </div>
        </div>
        <?php }  if (SYS_ADMIN_OAUTH && $oauth) { ?>
        <link href="<?php echo $THEME_PATH; ?>assets/icon/css/icon.css?v=<?php echo CMF_UPDATE_TIME; ?>" rel="stylesheet" type="text/css" />
        <div class="login-oauth">
            <?php if (is_array($oauth)) { $key_t=-1;$count_t=dr_count($oauth);foreach ($oauth as $t) { $key_t++; $is_first=$key_t==0 ? 1 : 0;$is_last=$count_t==$key_t+1 ? 1 : 0;?>
            <a href="<?php echo $t['url']; ?>" class="tooltips" data-container="body" data-placement="top" data-original-title="<?php echo $t['title']; ?>"><i class="fa fa-<?php echo $t['name']; ?>"></i></a>
            <?php } } ?>
        </div>
        <?php } ?>
    </form>
</div>
<?php if ($license['name']) {  if ($license['url']) { ?>
<div class="copyright" style="display:none;"> <a style="color: #fff" href="<?php echo $license['url']; ?>" target="_blank"><?php echo $license['name']; ?></a> </div>
<?php }  } else { ?>
<div class="copyright" style="display:none;"> <a style="color: #fff" href="https://www.xunruicms.com" target="_blank">迅睿CMS开源框架</a> </div>
<?php } ?>
<script src="<?php echo $THEME_PATH; ?>assets/global/plugins/jquery.min.js?v=<?php echo CMF_UPDATE_TIME; ?>" type="text/javascript"></script>
<script src="<?php echo $THEME_PATH; ?>assets/global/plugins/jquery.md5.js?v=<?php echo CMF_UPDATE_TIME; ?>" type="text/javascript"></script>
<script src="<?php echo $THEME_PATH; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js?v=<?php echo CMF_UPDATE_TIME; ?>" type="text/javascript"></script>
<script src="<?php echo $THEME_PATH; ?>assets/global/plugins/backstretch/jquery.backstretch.min.js?v=<?php echo CMF_UPDATE_TIME; ?>" type="text/javascript"></script>
<script src="<?php echo $THEME_PATH; ?>assets/global/scripts/app.min.js?v=<?php echo CMF_UPDATE_TIME; ?>" type="text/javascript"></script>
<script type="text/javascript">
    var is_admin = 2;
    if (typeof parent.layer == 'function') {
        parent.layer.closeAll('loading');
    }
    function dr_submit() {
        $('.alert-danger', $('.login-form')).hide();
        // 这里进行md5加密存储
        var pwd = $('#password').val();
        if (pwd.length == 32) {
            // 已经加密过的
        } else {
            pwd = $.md5(pwd); // 进行md5加密
            $('#password').val(pwd);
        }
        $.ajax({type: "POST",dataType:"json", url: '<?php echo $login_url; ?>', data: $(".login-form").serialize(),
            success: function(json) {
                // token 更新
                if (json.token) {
                    var token = json.token;
                    $(".login-form input[name='"+token.name+"']").val(token.value);
                }
                if (json.code == 1) {
                    window.location.href = json.data.url;
                } else {
                    $('.fc-code img').click();
                    $('.alert-danger span', $('.login-form')).html(json.msg);
                    $('.alert-danger', $('.login-form')).show();
                }
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                $('.fc-code img').click();
                var msg = HttpRequest.responseText;
                if (!msg) {
                    $('.alert-danger span', $('.login-form')).html("<?php echo dr_lang('系统错误'); ?>");
                    $('.alert-danger', $('.login-form')).show();
                } else {
                    $('.alert-danger span', $('.login-form')).html(msg);
                    $('.alert-danger', $('.login-form')).show();
                }
            }
        });
        return false;
    }
    <?php $bg = array('"'.$THEME_PATH.'assets/global/login/1.jpg"',
            '"'.$THEME_PATH.'assets/global/login/2.jpg"',
            '"'.$THEME_PATH.'assets/global/login/3.jpg"',
            '"'.$THEME_PATH.'assets/global/login/4.jpg"');
    shuffle($bg);
    ?>
    jQuery(document).ready(function() {
        $.backstretch([
            <?php echo implode(',', $bg); ?>
        ], {
            fade: 1000,
            duration: 8000
        }
        );
        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                dr_submit();
                return false;
            }
        });
        top.$('#dr_go_url').hide();
    });
</script>
<?php if (isset($_GET['isback']) && $_GET['isback']) { ?>
<script type="text/javascript">
    $(function(){
        dr_tips(<?php echo intval($_GET['iscode']); ?>, "<?php echo dr_safe_replace($_GET['isback']); ?>")
    });
</script>
<?php } ?>
</body>
</html>