<!doctype html>
<html>
<head>
    <title>Test</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/main.css" />
    <!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/themes/sunny/jquery-ui.css" /> -->
    <?php
    if (isset($this->css))
    {
        foreach ($this->css as $css)
        {
            echo '<link rel="stylesheet" href="'.URL.'views/'.$css.'">';
        }
    }
    ?>

    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-3.5.1.min.js"></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="<?php echo URL; ?>public/js/main.js"></script>

    <?php
    if (isset($this->js))
    {
        foreach ($this->js as $js)
        {
            echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
        }
    }
    ?>
</head>
<body>

<div id="header">

    <?php if (Session::get('loggedIn') == false):?>
        <a href="<?php echo URL; ?>index">Index</a>
        <a href="<?php echo URL; ?>help">Help</a>
    <?php endif; ?>
    <?php if (Session::get('loggedIn') == true):?>
        <a href="<?php echo URL; ?>dashboard">Dashboard</a>
        <a href="<?php echo URL; ?>note">Notes</a>

        <?php if (Session::get('role') == 'owner'):?>
        <a href="<?php echo URL; ?>user">Users</a>
        <?php endif; ?>

        <a href="<?php echo URL; ?>login/logout">Logout</a>
    <?php else: ?>
        <a href="<?php echo URL; ?>login">Login</a>
    <?php endif; ?>
</div>

<div id="content">
