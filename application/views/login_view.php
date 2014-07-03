<link rel="stylesheet" href="<?= base_url ('public/loginform/css/style.css') ?>">
<section class="container_loginform">
    <div class="login">
        <h1>เข้าสู่ระบบ</h1>
        <form method="post" action="index.html">
            <p>
                <input type="text" name="login" value="" placeholder="Username or Email">
            </p>
            <p>
                <input type="password" name="password" value="" placeholder="Password">
            </p>
            <p class="remember_me">
                <label>
                    <input type="checkbox" name="remember_me" id="remember_me">
                    Remember me on this computer </label>
            </p>
            <p class="submit">
                <input type="submit" name="commit" value="Login">
            </p>
        </form>
    </div>
</section>
