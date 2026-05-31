{extends file='../Layout/Layout.tpl'}
{block name=main}

    <div class="category_page">
        <div class="category_container">
            <div class="inner_wrapper">

                <div class="category_header">
                    <h1 class="category_title">{$category->Name}</h1>
                    <p class="category_description">{$category->Description}</p>
                </div>

                <div class="sort_bar">
                    <span class="sort_label">Sort by:</span>
                    <a class="sort_option{if $sortBy == 'date'} active{/if}"
                       href="?id={$category->Id}&sort=date">Publication Date</a>
                    <a class="sort_option{if $sortBy == 'views'} active{/if}"
                       href="?id={$category->Id}&sort=views">View Count</a>
                </div>

                <div class="article_cards_container">
                    {foreach $articles as $article}
                        <div class="article_card">
                            <img src="{$article->ImagePath}" class="image" alt="{$article->Title}"/>
                            <p class="title">{$article->Title}</p>
                            <div class="article_metadata">
                                <span class="date">{$article->PublicationDate}</span>
                                <span class="views">{$article->ViewCount} views</span>
                            </div>
                            <p class="content">{$article->Text}</p>
                            <a class="continue_button">Continue Reading</a>
                        </div>
                    {/foreach}
                </div>


            </div>
        </div>
    </div>

{/block}

