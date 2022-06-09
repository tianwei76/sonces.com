<?php if ($fn_include = $this->_include("header.html")) include($fn_include);  if (IS_DEV) { ?>
<div class="note note-danger">
    <p><a style="color: red" href="javascript:dr_help(204);">当前环境参数已经开启开发者模式，项目上线后建议关闭开发者模式</a></p>
</div>
<?php } ?>

<div class="row">



    <div class="col-md-12 col-sm-12">
        <?php if ($fn_include = $this->_include("main/notice.html")) include($fn_include); ?>
    </div>
</div>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>