{extends file='../Layout/Layout.tpl'}
{block name=main}
    <ul>
    {foreach $Categories as $category}
        <li>{$category->Name} - {$category->Description}</li>
    {/foreach}
    </ul>
{/block}