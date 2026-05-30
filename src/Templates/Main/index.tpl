{* Smarty *}
<html>
    <head>
        <title>{$title}</title>
    </head>
    <body>
        <ul>
        {foreach $categories as $category}
            <li>{$category->Name} - {$category->Description}</li>
        {/foreach}
        </ul>
    </body>
</html>