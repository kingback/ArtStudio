<!DOCTYPE html>
<font color="red">
<?php echo $this->Session->flash('auth'); ?>
</font>
        <h2>Admin登录</h2>
        <div class="page_form_wrap c">
            <div class="sep20"></div>
            <div class="sep20"></div>
            <form method="post" action="/admin/login">
                <p>
                <label for="username">用户名</label>
                <input class="s r3px" id="username" name="username" type="text" value="" />
                </p>
                <p>
                <label for="password">密码</label>
                <input class="s r3px" id="password" name="password" type="password" value="" />
                </p>
                <p class="fr">
                <input tabindex="4" class="button_blue r3px" type="submit" name="" value="登录" />
                </p>
                <div class="c"></div>
            </form>
        </div>
    </div>
</body>
</html>
