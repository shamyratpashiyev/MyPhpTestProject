{* Smarty *}
<html>
    <head>
        <title>{$title}</title>
    </head>
    <body>
        <ul>
        {foreach $menu as $menuItem}
            <li>{$menuItem['name']}</li>
        {/foreach}
        </ul>
    </body>
</html>